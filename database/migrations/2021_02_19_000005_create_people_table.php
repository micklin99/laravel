<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable()->default("");
            $table->string('middleName')->nullable()->default("");
            $table->string('lastName')->nullable()->default("");
            $table->string('displayName')->nullable()->default("");
            $table->string('avatar')->nullable()->default("");
	    $table->char('gender')->nullable()->default("");
	    $table->date('dateOfBirth')->nullable()->useCurrent();
	    $table->boolean('accountOwner')->default(false);
	    $table->foreignId('user_id')->nullable()->constrained();
	    $table->foreignId('club_id')->nullable()->constrained();
	    $table->foreignId('contact_id')->nullable()->constrained();
            $table->timestamps();
        });
	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
