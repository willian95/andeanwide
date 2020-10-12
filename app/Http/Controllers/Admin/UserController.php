<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminReceiveUserAddressProofEvent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\AdminRejectUserIdentityProofEvent;
use App\Events\AdminReceiveUserIdentityProofEvent;
use App\Events\AdminRejectUserAddressProofEvent;

class UserController extends Controller
{
    public function index()
    {
        $users = User::role('user')->orderBy('id', 'DESC')->get();
        return view('panel.admin.users.index', [
            'users' => $users
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->country;
        $user->identity;
        $user->address;

        // return response()->json($user);

        return view('panel.admin.users.show', [
            'user'  => $user,
        ]);
    }

    public function validateIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));
        $user->identity->verified_at = now();
        $user->identity->save();

        event(new AdminReceiveUserIdentityProofEvent($user));

        if(
            !is_null($user->identity) &&
            !is_null($user->identity->verified_at) &&
            !is_null($user->address) &&
            !is_null($user->address->verified_at))
        {
            $user->account_verified_at = now();
            $user->save();
        }

        return redirect()->route('panel.admin.users.show', ['id' => $user->id]);
    }

    public function unvalidateIdentity(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'reasons'       => 'required',
        ]);

        $user = User::find($request->input('user_id'));
        $user->identity()->delete();

        event(new AdminRejectUserIdentityProofEvent($user, $request->input('reasons')));

        return redirect()->route('panel.admin.users.show', ['id' => $user->id]);
    }

    public function validateAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('user_id'));
        $user->address->verified_at = now();
        $user->address->save();

        if(
            !is_null($user->identity) &&
            !is_null($user->identity->verified_at) &&
            !is_null($user->address) &&
            !is_null($user->address->verified_at))
        {
            $user->account_verified_at = now();
            $user->save();
        }

        event(new AdminReceiveUserAddressProofEvent($user));

        return redirect()->route('panel.admin.users.show', ['id' => $user->id]);
    }

    public function unvalidateAddress(Request $request)
    {
        $request->validate([
            'user_id'       => 'required|exists:users,id',
            'reasons'       => 'required',
        ]);

        $user = User::find($request->input('user_id'));
        $user->address()->delete();

        event(new AdminRejectUserAddressProofEvent($user, $request->input('reasons')));

        return redirect()->route('panel.admin.users.show', ['id' => $user->id]);
    }
}
