<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('url');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('culture')->nullable();
            $table->string('born')->nullable();
            $table->string('died')->nullable();
            $table->json('titles');
            $table->json('aliases');
            $table->string('father');
            $table->string('mother');
            $table->string('spouse');
            $table->json('allegiances');
            $table->json('books');
            $table->json('povBooks');
            $table->json('tvSeries');
            $table->json('playedBy');
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
        Schema::dropIfExists('characters');
    }
}
