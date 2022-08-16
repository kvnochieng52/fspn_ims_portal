<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerInputItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_input_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmer_id')->nullable($value = true);
            $table->bigInteger('farmer_input_id')->nullable($value = true);
            $table->bigInteger('input_id')->nullable($value = true);
            $table->bigInteger('sub_input_id')->nullable($value = true);
            $table->string('quantity')->nullable($value = true);
            $table->bigInteger('unit_id')->nullable($value = true);
            $table->text('description')->nullable($value = true);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('farmer_input_items');
    }
}
