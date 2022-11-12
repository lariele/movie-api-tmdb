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
        Schema::create('api_tmdb_movies', function (Blueprint $table) {
            $table->id('tmdb_id');

            #$table->bigInteger('tmdb_id')->index();
            $table->string('imdb_id')->nullable()->index();
            $table->date('release_date')->nullable();
            $table->string('status')->nullable();
            $table->string('title')->nullable();

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
        Schema::dropIfExists('api_tmdb_movies');
    }
};
