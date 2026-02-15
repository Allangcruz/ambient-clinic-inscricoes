<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function autenticar(): string
    {
        return view('auth/login');
    }
}
