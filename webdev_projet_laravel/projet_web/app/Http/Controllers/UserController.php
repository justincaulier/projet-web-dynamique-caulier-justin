<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\CompleteRegistrationRequest;
use App\Http\Requests\User_Form_Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Mail\CompleteRegistrationMail;
use App\Models\Adresse;
use App\Models\ProviderPhoto;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\AddressRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    protected AddressRepository $addressRepo;
    protected UserRepository $userRepo;
    protected CategoryRepository $categoryRepo;

    public function __construct(
        UserRepository $userRepo,
        CategoryRepository $categoryRepo,
        AddressRepository $addressRepo
    )
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
        $this->addressRepo = $addressRepo;
    }

    /**
     * Affiche la page d'accueil avec les providers
     */
    public function index(): View
    {
        try {
            $users = $this->userRepo->index(3);
            $categories = $this->categoryRepo->getAll();
            $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];

            return view('home', compact('users','categories','sliderImages'));
        } catch (\Exception $e) {
            abort(500, 'Erreur lors du chargement des providers : '.$e->getMessage());
        }
    }

    /**
     * Formulaire d'inscription
     */
    // Affiche le formulaire de création d'utilisateur
    public function create(): View
    {
        return view('users.create');
    }

    // Stocke l'utilisateur initial (inscription avant email)
    public function store(User_Form_Request $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        unset($data['confirm-password']);

        $user = User::create($data);

        // Générer un token de confirmation
        $user->remember_token = Str::random(60);
        $user->save();

        // Envoyer mail pour compléter l'inscription
        Mail::to($user->email)->send(new CompleteRegistrationMail($user));

        return redirect()->route('user.index')
            ->with('success', 'Utilisateur créé. Un mail a été envoyé pour compléter l’inscription !');
    }

    // Affiche le formulaire de complétion (via email)
    // GET /complete-registration/{user}
    public function showCompleteRegistration(User $user)
    {
        if ($user->registration_confirmed) {
            return redirect()->route('home')
                ->with('info', 'Inscription déjà complétée.');
        }

        return view('auth.complete-registration', compact('user'));
    }

// POST /complete-registration/{user}
    public function storeCompleteRegistration(CompleteRegistrationRequest $request, User $user)
    {
        $data = $request->validated();
        unset($data['confirm-password']);

        $user->password = bcrypt($data['password']);
        $user->role = $request->has('is_provider') ? 'PROVIDER' : 'USER';

        if ($user->role === 'PROVIDER') {
            $user->tva = $data['tva'] ?? null;
            $user->telephone = $data['telephone'] ?? null;
            $user->website = $data['website'] ?? null;
            $user->description = $data['description'] ?? null;

            // Adresse
            $addressData = array_filter($request->only(['street','number','box','city','postcode','country']));
            if (!empty($addressData)) {
                $address = Adresse::firstOrCreate($addressData);
                $user->address_id = $address->id;
            }

            // Photo
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('providers_photos','public');
                $user->avatar = basename($path);
            }
        }

        $user->registration_confirmed = true;
        $user->remember_token = Str::random(60);
        $user->save();

        return redirect()->route('home')
            ->with('success', 'Inscription complétée avec succès ! Vous pouvez maintenant vous connecter.');
    }

    /**
     * Affiche un utilisateur
     */
    public function show(int $id): View
    {
        try {
            $user = $this->userRepo->show($id, ['address','categories']);
            return view('users.show', compact('user'));
        } catch (\Exception $e) {
            abort(404, 'Utilisateur introuvable.');
        }
    }

    /**
     * Profil actuel
     */
    public function profile(): View
    {
        try {
            $user = Auth::user();
            return $user->role === UserRole::PROVIDER
                ? view('profile.provider', compact('user'))
                : view('profile.user', compact('user'));
        } catch (\Exception $e) {
            abort(500, 'Erreur lors du chargement du profil : '.$e->getMessage());
        }
    }

    /**
     * Mise à jour du profil
     */
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        try {

            $user = Auth::user();
            $data = $request->validated();

            //User Data

            $userData = [
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
            ];

            if ($request->hasFile('avatar')) {

                $filename = $user->id.'_'.time().'.'.$request->avatar->extension();

                $request->avatar->storeAs('avatars', $filename, 'public');

                $userData['avatar'] = $filename;
            }

            if ($user->role === UserRole::PROVIDER) {
                $userData['tva'] = $data['tva'] ?? null;
            }

            $this->userRepo->update($user->id, $userData);


           //Adresse

            if (!empty($data['street'])) {

                $address = $this->addressRepo->findOrCreate([
                    'street' => $data['street'],
                    'number' => $data['number'] ?? null,
                    'box' => $data['box'] ?? null,
                    'city' => $data['city'] ?? null,
                    'postcode' => $data['postcode'] ?? null,
                    'country' => $data['country'] ?? null,
                ]);

                $user->address_id = $address->id;
                $user->save();
            }


           //Provider photos

            if ($user->role === UserRole::PROVIDER && $request->hasFile('photos')) {

                foreach ($request->file('photos') as $photo) {

                    $filename = $user->id.'_photo_'.time().'_'.$photo->getClientOriginalName();

                    $photo->storeAs('providers_photos', $filename, 'public');

                    ProviderPhoto::create([
                        'user_id' => $user->id,
                        'path' => $filename,
                    ]);
                }
            }

            return back()->with('success', 'Profil mis à jour avec succès.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du profil.');
        }
    }
}
