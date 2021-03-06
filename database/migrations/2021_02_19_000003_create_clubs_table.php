<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
	    $table->string('name');
	    $table->string('website');
	    $table->string('subdomain');                // the subdomain string 'xxx' for 'http://xxx.fortygoals.com'
	    $table->boolean('active')->default(true);   // the state of the club
            $table->timestamps();
	    $table->softDeletes();                      // support soft deletes for 'Clubs'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubs');
    }
}
