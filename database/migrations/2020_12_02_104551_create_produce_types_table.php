<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produce_types', function (Blueprint $table) {
            $table->id();
            $table->string('produce_type_name')->nullable($value = true);
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
        Schema::dropIfExists('produce_types');
    }
}
