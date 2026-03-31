<?php

namespace App\Http\Controllers;

use App\Http\Requests\User_Form_Request;
use App\Mail\CompleteRegistrationMail;
use App\Repositories\UserRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    protected UserRepository $userRepo;
    protected CategoryRepository $categoryRepo;

    public function __construct(UserRepository $userRepo, CategoryRepository $categoryRepo)
    {
        $this->userRepo = $userRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Liste complète des providers (sans recherche).
     */
    public function index(Request $request): View|JsonResponse
    {
        try {
            $users = $this->userRepo->index(3); // ✔ paginator
            $categories = $this->categoryRepo->getAll();
            $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];
            $query = '';

            return view('home', compact('users','categories','sliderImages','query'));
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

    }



    /**
     * Recherche des providers avec pagination
     */
    public function search(Request $request): View|JsonResponse
    {
        try {
            $query = $request->input('search', '');
            $perPage = 3;

            $users = $this->userRepo->search($query, $perPage);
            $categories = $this->categoryRepo->getAll();
            $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];

            return view('home', compact('users','categories','sliderImages','query'));
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Affiche les providers d'une catégorie
     */
    public function showByCategory(int $categoryId): View|JsonResponse
    {
        try {
            $users = $this->userRepo->getProvidersByCategory($categoryId, 3);
            $categories = $this->categoryRepo->getAll();
            $sliderImages = ['bienetre1.jpg','bienetre2.jpg','bienetre3.jpg'];

            $category = $this->categoryRepo->findById($categoryId);

            $query = $category->name;

            return view('home', compact('users','categories','sliderImages','query'));
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Affiche un provider
     */
    public function show(int $id): View|JsonResponse
    {
        try {
            $user = $this->userRepo->show($id, ['address','categories']);
            return view('users.show', compact('user'));
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

    }
    //Fonction pour afficher le formulaire
    public function create(): View|JsonResponse
    {
        try {
            return view('createUserForm');
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()]);
        }

    }
    public function store(User_Form_Request $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            unset($data['confirm-password']);

            // Crée le user
            $user = $this->userRepo->create($data);

// Génération du token **avant l'envoi du mail**
            $user->remember_token = Str::random(60);
            $user->save();

// Envoi du mail
            Mail::to($user->email)->send(new CompleteRegistrationMail($user));


            return redirect()->route('user.index')
                ->with('success', 'Utilisateur créé avec succès. Un mail a été envoyé pour compléter l’inscription !');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur : '.$e->getMessage());
        }
    }


}
