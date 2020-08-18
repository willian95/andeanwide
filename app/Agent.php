<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'r_legal_name',
        'r_legal_lastname',
        'r_nationality',
        'r_birthday',
        'r_pais_residencia',
        'r_rut',
        'r_serie',
        'r_telefono',
        'e_name',
        'e_fantasy',
        'e_rut',
        'e_address',
        'e_city',
        'e_country',
        'e_zip',
    ];

}
