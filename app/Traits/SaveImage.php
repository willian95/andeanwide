<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SaveImage
{
    public function saveImage($file, $path=null)
    {
        if(is_null($file)) return null;

        if(is_null($path))
        {
            $user = Auth::user();
            $path = "images/user/$user->id";
        }
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($path, $name, 'public');
        return asset('') . 'storage/' . $path;
    }
}
