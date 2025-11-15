<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoTipsTable extends Migration
{
    public function up()
    {
        Schema::create('eco_tips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('category')->nullable()->index();
            $table->string('impact_level')->nullable()->default('low'); // low/medium/high
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eco_tips');
    }
}
