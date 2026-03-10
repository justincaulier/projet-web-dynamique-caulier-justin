<?php
namespace App\Http\Controllers;

use App\Http\Requests\CompleteRegistrationRequest;
use App\Repositories\UserRepository;
use App\Services\RegistrationService;
use Illuminate\Support\Facades\Log;

class RegistrationCompletionController extends Controller
{
    protected UserRepository $users;
    private RegistrationService $registrationService;

    public function __construct(UserRepository $users, RegistrationService $registrationService)
    {
        $this->users = $users;
        $this->registrationService = $registrationService;
    }

    // Affiche le formulaire
    public function show(int $id)
    {
        try {
            $user = $this->users->findByIdOrFail($id);

            if ($user->registration_confirmed) {
                return redirect()->route('home')
                    ->with('message', 'Inscription déjà complétée.');
            }

            return view('auth.complete-registration', compact('user'));

        } catch (\Exception $e) {
            Log::error("Erreur show registration: " . $e->getMessage());
            abort(404);
        }
    }

    // Stocke la complétion
    public function store(CompleteRegistrationRequest $request, int $id)
    {
        try {
            $user = $this->users->findByIdOrFail($id);

            $data = $request->validated();

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo');
            }

            $this->registrationService->completeRegistration($user, $data);

            return redirect()->route('home')
                ->with('success', 'Inscription complétée avec succès !');

        } catch (\Exception $e) {
            Log::error("Erreur store registration: " . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}
