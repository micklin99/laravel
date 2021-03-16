<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address1')->nullable()->default("");
            $table->string('address2')->nullable()->default("");
            $table->string('city')->nullable()->default("");
	    $table->foreignId('state_id')->nullable()->constrained();     // fk to 'states(id)'
            $table->string('province')->nullable()->default("");
	    $table->foreignId('country_id')->nullable()->constrained();   // fk to 'countries(id)'
            $table->string('postalCode')->nullable()->default("00000");	    
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
	Schema::disableForeignKeyConstraints();    
        Schema::dropIfExists('addresses');
	Schema::enableForeignKeyConstraints();    
    }
}
