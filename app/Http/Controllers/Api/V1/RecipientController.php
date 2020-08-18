<?php

namespace App\Http\Controllers\Api\V1;

use App\Recipient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipientResource;
use Illuminate\Support\Facades\Auth;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $recipients = Recipient::where('user_id', $user->id)->paginate(15);
        return RecipientResource::collection($recipients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id'            => 'required|exists:countries,id',
            'name'                  => 'required|max:255',
            'lastname'              => 'required|max:255',
            'dni'                   => 'required|max:255',
            'phone'                 => 'required|max:255',
            'email'                 => 'required|email|max:255',
            'bank_name'             => 'required|max:255',
            'bank_account'          => 'required|max:255',
            'code'                  => 'required|max:255',
            'address'               => 'required|max:255',
        ]);

        $user = Auth::user();

        $recipient = new Recipient();
        $recipient->user_id = $user->id;
        $recipient->country_id = $request->input('country_id');
        $recipient->name = $request->input('name');
        $recipient->lastname = $request->input('lastname');
        $recipient->dni = $request->input('dni');
        $recipient->phone = $request->input('phone');
        $recipient->email = $request->input('email');
        $recipient->bank_name = $request->input('bank_name');
        $recipient->bank_account = $request->input('bank_account');
        $recipient->address = $request->input('address');
        $recipient->code = $request->input('code');
        $recipient->save();

        return new RecipientResource($recipient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipient $recipient)
    {
        return new RecipientResource($recipient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipient $recipient)
    {
        $request->validate([
            'country_id'            => 'required|exists:countries,id',
            'name'                  => 'required|max:255',
            'lastname'              => 'required|max:255',
            'dni'                   => 'required|max:255',
            'phone'                 => 'required|max:255',
            'email'                 => 'required|email|max:255',
            'bank_name'             => 'required|max:255',
            'bank_account'          => 'required|max:255',
            'code'                  => 'required|max:255',
            'address'               => 'required|max:255',
        ]);

        $recipient->country_id = $request->input('country_id', $recipient->country_id);
        $recipient->name = $request->input('name', $recipient->name);
        $recipient->lastname = $request->input('lastname', $recipient->lastname);
        $recipient->dni = $request->input('dni', $recipient->dni);
        $recipient->phone = $request->input('phone', $recipient->phone);
        $recipient->email = $request->input('email', $recipient->email);
        $recipient->bank_name = $request->input('bank_name', $recipient->bank_name);
        $recipient->bank_account = $request->input('bank_account', $recipient->bank_account);
        $recipient->address = $request->input('address', $recipient->address);
        $recipient->code = $request->input('code', $recipient->code);
        $recipient->save();

        return new RecipientResource($recipient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipient $recipient)
    {
        $recipient->delete();
        return new RecipientResource($recipient);
    }
}
