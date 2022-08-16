<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduceSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produce_sub_types', function (Blueprint $table) {
            $table->id();
            $table->string('produce_sub_type_name')->nullable($value = true);
            $table->bigInteger('produce_id')->nullable($value = true);
            $table->text('description')->nullable($value = true);
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('produce_sub_types');
    }
}
