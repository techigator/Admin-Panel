<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    /**
     * Write code on Method
     *
     * @return View|Factory|Application ()
     */
    public function index(): View|Factory|Application
    {
        return view('front.firebase-otp');
    }
}
