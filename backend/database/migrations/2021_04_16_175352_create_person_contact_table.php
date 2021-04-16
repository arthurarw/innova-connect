<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_contacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('CASCADE');

            $table->smallInteger('contact_type');
            $table->string('contact');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_contact');
    }
}
