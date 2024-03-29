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
        Schema::create('api_tmdb_movies_data', function (Blueprint $table) {
            $table->foreignId('tmdb_id')->unique()->references('tmdb_id')->on('api_tmdb_movies')->cascadeOnDelete();
            #$table->foreign('tmdb_id')->references('tmdb_id')->on('api_tmdb_movies')->cascadeOnDelete();

            $table->boolean('adult');
            $table->string('backdrop_path')->nullable();
            $table->integer('budget');

            $table->text('genres');
            $table->string('homepage', 512)->nullable();

            $table->string('original_language');
            $table->string('original_title');
            $table->text('overview')->nullable();
            $table->float('popularity');
            $table->string('poster_path')->nullable();

            $table->text('production_companies');
            $table->text('production_countries');
            $table->bigInteger('revenue');
            $table->integer('runtime')->nullable();

            $table->text('spoken_languages');
            $table->string('tagline')->nullable();

            $table->boolean('video');
            $table->float('vote_average');
            $table->integer('vote_count');

            $table->text('keywords')->nullable();
            $table->text('videos')->nullable();
            $table->longText('images');
            $table->longText('credits')->nullable();
            $table->text('external_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_tmdb_movies_data');
    }
};
