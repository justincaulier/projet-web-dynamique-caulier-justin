<?php

namespace App\Http\Controllers;

use app\Repositories\UtilisateurRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UtilisateurController extends Controller
{
 public function index(): View|JsonResponse{
     try{
         $utilisateurs = app(UtilisateurRepository::class)->getAll();
         return view('utilisateur.index', compact('utilisateurs'));
     }catch (\Exception $e){
         return response()->json(["error" => $e->getMessage()]);
     }
 }
}
