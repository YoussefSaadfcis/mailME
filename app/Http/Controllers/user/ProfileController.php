<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile.home');
    }
}
