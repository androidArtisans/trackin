<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrakinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trakins', function (Blueprint $table) {
            $table->id();
            $table->dateTimeTz('register_point_date', $precision = 0);
            $table->string('message_type');//automatic,manual
            $table->string('message');
            $table->decimal('latitude',10,8);
            $table->decimal('longitude',11,8);
            $table->foreignId('travel_id')->constrained('travel');
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
        Schema::dropIfExists('trakins');
    }
}
