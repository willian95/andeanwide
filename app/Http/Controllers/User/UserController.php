<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Address;
use App\Country;
use App\Events\UserSendAddressProofEvent;
use App\Events\UserSendIdentityProofEvent;
use App\Identity;
use Carbon\Carbon;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use SaveImage;

    public function verify()
    {
        $user = Auth::user();
        $user->identity;
        $user->address;
        $countries = Country::select('id', 'name')->get();

        return view('panel.user.verify.index', [
            'user'      => $user,
            'countries' => $countries
        ]);
    }

    public function createIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'country_id'    => 'required|numeric|exists:countries,id',
            'nationality'   => 'required|max:255',
            'first_name'    => 'required|max:255',
            'last_name'     => 'required|max:255',
            'dni_number'    => 'required|max:255',
            'expiration_date'   => 'required|date|after:today',
            'issue_date'    => 'required|date|before:today',
            'dob'           => 'required|date|before:-18 years',
            'document_type' => 'required|in:dni,passport,driver_license',
            'gender'        => 'required|in:Unknown,F,M',
            'front_image'   => 'required|image|max:5120',
            'back_image'    => 'image|max:5120'
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $identity = new Identity;
        $identity->country_id = $request->input('country_id');
        $identity->nationality = $request->input('nationality');
        $identity->first_name = $request->input('first_name');
        $identity->middle_name = $request->input('middle_name');
        $identity->last_name = $request->input('last_name');
        $identity->second_surname = $request->input('second_surname');
        $identity->dni_number = $request->input('dni_number');
        $identity->validation_number = $request->input('validation_number');
        $identity->expiration_date = new Carbon($request->input('expiration_date'));
        $identity->issue_date = new Carbon($request->input('issue_date'));
        $identity->dob = new Carbon($request->input('dob'));
        $identity->document_type = $request->input('document_type');
        $identity->gender = $request->input('gender');
        $identity->front_image_url = $this->saveImage($request->file('front_image'));
        if($request->has('back_image'))
        {
            $identity->reverse_image_url = $this->saveImage($request->file('back_image'));
        }

        $user->identity()->save($identity);
        $user->name = $identity->first_name;
        $user->lastname = $identity->last_name;
        $user->identification = $identity->dni_number;
        $user->save();

        event(new UserSendIdentityProofEvent($user));

        return redirect()->route('panel.user.verify');
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'address'       => 'required|max:150',
            'address_ext'   => 'nullable|max:150',
            'country_id'    => 'required|numeric|exists:countries,id',
            'state'         => 'required|max:150',
            'city'          => 'required|max:150',
            'cod'           => 'required|max:50',
            'image'         => 'required|image|max:5120',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $address = new Address;
        $address->address = $request->input('address');
        $address->address_ext = $request->input('address_ext');
        $address->country_id = $request->input('country_id');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->cod = $request->input('cod');
        $address->image_url = $this->saveImage($request->file('image'));

        $user->address()->save($address);

        event(new UserSendAddressProofEvent($user));

        return redirect()->route('panel.user.verify');
    }
}
