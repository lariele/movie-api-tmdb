<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_tmdb_movies_credits', function (Blueprint $table) {
            $table->foreignId('tmdb_id')->unique()->references('tmdb_id')->on('api_tmdb_movies')->cascadeOnDelete();

            $table->longText('results');

            $table->timestamp('processed_at')->index()->nullable();

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
        Schema::dropIfExists('api_tmdb_movies_credits');
    }
};
