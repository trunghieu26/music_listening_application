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
        Schema::table('playlist_songs', function (Blueprint $table) {
            $table->string('user_id');
            $table->renameColumn('playlist_id', 'album_id');
            $table->dropColumn('song_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_songs', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->renameColumn('playlist_id', 'album_id');
            $table->dropColumn('song_id');
        });
    }
};
