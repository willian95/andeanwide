<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Address;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AddressResource;
use App\Events\UserSendAddressProofEvent;
use Intervention\Image\Facades\Image;

class AddressController extends Controller
{
    use SaveImage;

    public function index()
    {
        $user = Auth::user();
        if($user->address) {
            return new AddressResource($user->address);
        }
        return response()->json([
            'address'  => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'address'       => [ 'required', 'max:150' ],
            'address_ext'   => [ 'nullable', 'max:150' ],
            'country_id'    => [ 'required', 'numeric', 'exists:countries,id' ],
            'state'         => [ 'required', 'max:150'],
            'city'          => [ 'required', 'max:150'],
            'cod'           => [ 'required', 'max:50'],
            'image'         => [ 'required', 'image' ],
        ]);

        $user = Auth::user();
        $address = new Address;
        $address->address = $request->input('address');
        $address->address_ext = $request->input('address_ext');
        $address->country_id = $request->input('country_id');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->cod = $request->input('cod');
        $address->image_url = $this->saveImage($request->file('image'));

        $user->address()->save($address);

        event(new UserSendAddressProofEvent($user->fresh()));

        return new AddressResource($address);
    }

    public function storeApp(Request $request)
    {
        $request->validate([
            'address'       => [ 'required', 'max:150' ],
            'address_ext'   => [ 'nullable', 'max:150' ],
            'country_id'    => [ 'required', 'numeric', 'exists:countries,id' ],
            'state'         => [ 'required', 'max:150'],
            'city'          => [ 'required', 'max:150'],
            'cod'           => [ 'required', 'max:50'],
            'image'         => [ 'required'],
        ]);

        try{

            $imageData = $request->get('image');

            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('images/user/').$fileName);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

        $user = Auth::user();
        $address = new Address;
        $address->address = $request->input('address');
        $address->address_ext = $request->input('address_ext');
        $address->country_id = $request->input('country_id');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->cod = $request->input('cod');
        $address->image_url = url('/').'/images/user/'.$fileName;

        $user->address()->save($address);

        event(new UserSendAddressProofEvent($user->fresh()));
        return response()->json(["success" => true]);
        //return new AddressResource($address);
    }
}
