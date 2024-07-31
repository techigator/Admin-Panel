<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class FrontController extends Controller
{
    public function frontIndex(): View|Application|Factory
    {
        return view('front.index');
    }

    public function frontLogin(): View|Application|Factory
    {
        return view('front.auth.authentication-login');
    }

    public function frontRegister(): View|Application|Factory
    {
        return view('front.auth.authentication-register');
    }
}
