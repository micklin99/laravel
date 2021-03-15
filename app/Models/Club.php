<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Person;
use App\Models\Contact;


use Illuminate\Support\Facades\Log;

class Club extends Model
{
    use HasFactory;

    protected $table = "clubs";

    protected $fillable = [ 'name', 'website', 'subdomain' ];


    public function people()
    {
	$p = $this->hasMany('App\Models\Person');

	$first = $p->first();
	
	return $p;
    }


    public function admin()
    {
	//
	// get all of the people associated with this club
	//
	$people = $this->people();

	//
	// get the global administator role's id and search
	//   the club people, and find any that have 
	//   the global administrator role_id.
	//
	$role_id = Role::globalAdmin()->id;
	$result = $people->with( ['role' => function($q) use ($role_id) {
	    $q->where('role_id', $role_id);
	}]);

	Log::info("Role - Global Admin id: " . $role_id);

	//
	// we found a global system administrator, so return it...
	//
	if (($result != null) && ($result->first() != null))
	{
	    return $result->first();
	}


	//
	// get the club administator role's id and search
	//   the club people, and find any that have 
	//   the club administrator role_id.
	//
	$role_id = Role::clubAdmin()->id;
	$result = $people->with( ['role' => function($q) use ($role_id) {
	    $q->where('role_id', $role_id);
	}]);

	Log::info("Role - Club Admin id: " . $role_id);	
	
	//
	// we found a club system administrator, so return it...
	//
	if (($result != null) && ($result->first() != null))
	{
	    return $result->first();
	}

	//
	//  ERROR! -- This is a problem and will likely cause an Exception 
	//
	Log::error("Database error: No global or club administrator assigned to club: " . $this->name);
	return null;
    }   
}
