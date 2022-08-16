<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerProducesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_produces', function (Blueprint $table) {
            $table->id();
            $table->integer('farmer_id')->nullable($value = true);
            $table->bigInteger('produce_id')->nullable($value = true);
            $table->bigInteger('sub_produce_id')->nullable($value = true);
            $table->integer('capacity')->nullable($value = true);
            $table->integer('unit')->nullable($value = true);
            $table->decimal('production_area')->nullable($value = true);
            $table->text('production_image')->nullable($value = true);
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
        Schema::dropIfExists('farmer_produces');
    }
}
