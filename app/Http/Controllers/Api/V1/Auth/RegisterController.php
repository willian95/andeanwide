<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\User;
// use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'country_id'        => ['required', 'exists:countries,id'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed', 'regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})"'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'country_id'    => $data['country_id'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
        ]);

        $user->assignRole('user');
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return response()->json([
            'user' => $user
        ]);
    }
}

