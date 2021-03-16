<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventaddresses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default("");
            $table->foreignId('address_id')->nullable()->constrained();
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
        Schema::dropIfExists('eventaddresses');
	Schema::enableForeignKeyConstraints();    
    }
}
