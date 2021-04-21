<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disciplines');
    }
}
