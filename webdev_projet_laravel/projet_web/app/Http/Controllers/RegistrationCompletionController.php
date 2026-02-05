<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteRegistrationRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegistrationCompletionController extends Controller
{
    public function show($id)
    {

        $user = User::where('id', $id)->firstOrFail();

        if ($user->registration_confirmed) {
            return redirect('/login')->with('message', 'Inscription déjà complétée.');
        }

        return view('auth.complete-registration', compact('user'));
    }

    public function store(CompleteRegistrationRequest $request, $id)
    {
        try {
            $user = User::where('id', $id)->firstOrFail();

            $validated = $request->validated();

            $user->email = $validated['email'];

            if ($user->role === 'PROVIDER') {
                $user->name = $validated['name'];
                $user->surname = $validated['surname'];
                $user->description = $validated['description'] ?? null;
                $user->tva = $validated['tva'] ?? null;
                $user->website = $validated['website'] ?? null;
                $user->address = $validated['address'] ?? null;
                $user->phone = $validated['phone'] ?? null;

                if ($request->hasFile('photo')) {
                    $user->photo = $request->file('photo')->store('photos', 'public');
                }

                // Ici tu peux gérer les stages et promotions
            }

            $user->registration_confirmed = true;
            $user->save();

            return redirect('/login')->with('success', 'Inscription complétée !');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response(404);
        }

    }
}
