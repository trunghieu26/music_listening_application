<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_albums', function (Blueprint $table) {
            $table->string('id');
            $table->string('album_type');
            $table->string('artists_id');
            $table->json('external_urls');
            $table->string('href');
            $table->json('images');
            $table->string('name');
            $table->date('release_date');
            $table->integer('total_tracks');
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
        Schema::dropIfExists('artist_albums');
    }
};
