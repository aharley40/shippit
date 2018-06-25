<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'client_id',
    	'delivery_date',
    	'description',
    	'type',
        'name',
        'email',
        'phone'
    ];
}

