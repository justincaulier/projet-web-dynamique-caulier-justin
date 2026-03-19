<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        try{

            return view('admin.dashboard');

        }catch(\Exception $e){

            abort(500);

        }
    }
}
