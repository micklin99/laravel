<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_season', function (Blueprint $table) {
            $table->id();
	    $table->foreignId('schedule_id')->constrained();
	    $table->foreignId('season_id')->constrained();
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
        Schema::dropIfExists('schedule_season');
	Schema::enableForeignKeyConstraints();    
    }
}
