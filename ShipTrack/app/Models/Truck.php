<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'title',
        'vin',
        'license_plate',
        'insurance_provider',
        'insurance_number',
        'registration_number',
        'state_registered'
    ];
}
