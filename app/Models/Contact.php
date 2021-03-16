<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Address;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'primaryEmail',
        'secondaryEmail',
        'mobilePhone',
        'homePhone',
        'workPhone',
    ];

    public function address()
    {
        return $this->belongsTo('App\Models\Address')->withDefault();
    }

}
