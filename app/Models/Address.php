<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address1',
        'address2',
        'city',
        'province',
        'state_id',
        'province',
	'country_id',
	'postalCode',
    ];

    public function state()
    {
	return $this->belongsTo('App\Models\State')->withDefault();
    }

    public function country()
    {
	return $this->belongsTo('App\Models\Country')->withDefault();
    }
}
