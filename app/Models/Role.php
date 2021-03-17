<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' ];

    public static function globalAdmin()
    {
	return Role::where('title', 'Global System Administrator')->first();
    }

    public static function clubAdmin()
    {
	return Role::where('title', 'Club System Administrator')->first();
    }
    

}
