<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Log;

use App\Models\Club;
use App\Models\Contact;
use App\Models\User;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'accountOwner',
    ];

    public function user()
    {
	return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function role()
    {
	return $this->belongsToMany('App\Models\Role');
    }

    public function contact()
    {
	return $this->belongsTo('App\Models\Contact')->withDefault();
    }

    public function club()
    {
	return $this->belongsTo('App\Models\Club')->withDefault();
    }




}
