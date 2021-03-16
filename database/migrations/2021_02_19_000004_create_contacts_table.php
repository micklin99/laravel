<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('primaryEmail')->nullable()->default("");
            $table->string('secondaryEmail')->nullable()->default("");
            $table->string('mobilePhone')->nullable()->default("");
            $table->string('homePhone')->nullable()->default("");
            $table->string('workPhone')->nullable()->default("");
            $table->foreignId('address_id')->nullable()->constrained();    // fk to addresses(id)
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
        Schema::dropIfExists('contacts');
	Schema::enableForeignKeyConstraints();
    }
}
