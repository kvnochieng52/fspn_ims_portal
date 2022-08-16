<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSustainableGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sustainable_goals', function (Blueprint $table) {
            $table->id();
            $table->string('sdg_name');
            $table->text('sustainable_image')->nullable($value = true);
            $table->integer('active')->default(1);
            $table->integer('order')->nullable($value = true);
            $table->text('description')->nullable($value = true);
            $table->integer('created_by')->nullable($value = true);
            $table->integer('updated_by')->nullable($value = true);
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
        Schema::dropIfExists('sustainable_goals');
    }
}
