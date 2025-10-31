<?php

namespace App\Http\Controllers\user;

use App\Http\Requests\userCharacterRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCharacter;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('user.profile.profile',['user'=>$user]);
    }
    public function setUserCharacter(userCharacterRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        UserCharacter::updateOrCreate(['user_id' => $user->id], $data);
        return $user->character;
        // return redirect()->route('user.character')->with('success', 'Character updated successfully.');
    }
}

