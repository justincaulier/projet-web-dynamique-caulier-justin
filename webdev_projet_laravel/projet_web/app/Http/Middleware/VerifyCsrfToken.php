<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Les routes à exclure de la vérification CSRF.
     */
    protected $except = [
        'complete-registration/*', // la route de complétion n’a pas besoin de CSRF
    ];
}
