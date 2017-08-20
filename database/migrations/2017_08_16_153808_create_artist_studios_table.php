<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_studios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('artist_id');
            $table->unsignedInteger('studio_id');
            $table->string('status');
            $table->date('start')->nullable(true);
            $table->date('end')->nullable(true);

            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('studio_id')->references('id')->on('studios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artist_studios');
    }
}
