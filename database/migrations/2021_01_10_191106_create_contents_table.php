<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discipline_id')->constrained();
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
        Schema::dropIfExists('contents');
    }
}
