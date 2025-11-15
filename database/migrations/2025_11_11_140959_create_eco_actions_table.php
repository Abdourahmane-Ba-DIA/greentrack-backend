<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcoActionsTable extends Migration
{
    public function up()
    {
        Schema::create('eco_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('type')->index();
            $table->decimal('impact_co2', 10, 2)->nullable()->default(0);
            $table->decimal('impact_water', 10, 2)->nullable()->default(0);
            $table->decimal('impact_waste', 10, 2)->nullable()->default(0);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('eco_actions');
    }
}
