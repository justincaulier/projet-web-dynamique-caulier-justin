<?php

namespace App\Http\Controllers;

use app\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserController extends Controller
{
 public function index(): View|JsonResponse{
     try{
         $users = app(UserRepository::class)->index();
         return view('user.index', compact('users'));
     }catch (\Exception $e){
         return response()->json(["error" => $e->getMessage()]);
     }
 }
}
