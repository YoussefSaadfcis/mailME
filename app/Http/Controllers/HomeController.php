<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class HomeController extends ControllerResolver
{
    public function index()
    {
        return view('user.profile.home');
    }
}
