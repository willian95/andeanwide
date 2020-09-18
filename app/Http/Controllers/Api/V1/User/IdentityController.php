<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Identity;
use Carbon\Carbon;
use App\Traits\SaveImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\IdentityResource;
use App\Events\UserSendIdentityProofEvent;
use Intervention\Image\Facades\Image;

class IdentityController extends Controller
{
    use SaveImage;

    public function index()
    {
        $user = Auth::user();
        if($user->identity) {
            return new IdentityResource($user->identity);
        }
        return response()->json([
            'identity'  => null,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'country_id'        => [ 'required', 'numeric', 'exists:countries,id' ],
            'nationality'       => [ 'required', 'max:255' ],
            'first_name'        => [ 'required', 'max:255' ],
            'last_name'         => [ 'required', 'max:255' ],
            'dni_number'        => [ 'required', 'max:255' ],
            'expiration_date'   => [ 'required', 'date', 'after:today' ],
            'issue_date'        => [ 'required', 'date', 'before:today' ],
            'dob'               => [ 'required', 'date', 'before:-18 years' ],
            'document_type'     => [ 'required', 'in:dni,passport,driver_license' ],
            'gender'            => [ 'required', 'in:Unknown,F,M' ],
            'front_image'       => [ 'required', 'image' ],
            'back_image'        => [ 'required_if:document_type,dni', 'required_if:document_type,driver_license', 'image' ],
        ]);

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
        $identity->reverse_image_url = $this->saveImage($request->file('back_image'));

        $user->identity()->save($identity);
        $user->name = $identity->first_name;
        $user->lastname = $identity->last_name;
        $user->identification = $identity->dni_number;
        $user->save();

        event(new UserSendIdentityProofEvent($user->fresh()));

        return new IdentityResource($user->identity);
    }

    

    public function storeApp(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'country_id'        => [ 'required', 'numeric', 'exists:countries,id' ],
            'nationality'       => [ 'required', 'max:255' ],
            'first_name'        => [ 'required', 'max:255' ],
            'last_name'         => [ 'required', 'max:255' ],
            'dni_number'        => [ 'required', 'max:255' ],
            'expiration_date'   => [ 'required', 'date', 'after:today' ],
            'issue_date'        => [ 'required', 'date', 'before:today' ],
            'dob'               => [ 'required', 'date', 'before:-18 years' ],
            'document_type'     => [ 'required', 'in:dni,passport,driver_license' ],
            'gender'            => [ 'required', 'in:Unknown,F,M' ],
            'front_image'       => [ 'required' ],
            'back_image'        => [ 'required_if:document_type,dni', 'required_if:document_type,driver_license' ],
        ]);

        try{

            $imageData = $request->get('front_image');

            $fileNameFrontImage = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            dd($imageData);
            Image::make($imageData)->save(public_path('images/user/').$fileNameFrontImage);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen front", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

        if($request->get('back_image')){

            try{

                $imageData = $request->get('back_image');
    
                $fileNameRearImage = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Image::make($request->get('back_image'))->save(public_path('images/user/').$fileNameRearImage);
    
            }catch(\Exception $e){
    
                return response()->json(["success" => false, "msg" => "Hubo un problema con la imagen rear", "err" => $e->getMessage(), "ln" => $e->getLine()]);
    
            }

        }

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
        $identity->front_image_url = url('/').'/images/user/'.$fileNameFrontImage;
        $identity->reverse_image_url = url('/').'/images/user/'.$fileNameRearImage;

        $user->identity()->save($identity);
        $user->name = $identity->first_name;
        $user->lastname = $identity->last_name;
        $user->identification = $identity->dni_number;
        $user->save();

        event(new UserSendIdentityProofEvent($user->fresh()));
        return response()->json(["success" => true]);
        //return new IdentityResource($user->identity);
    }
}
