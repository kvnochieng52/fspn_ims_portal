<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable($value = true);
            $table->string('last_name')->nullable($value = true);
            $table->string('id_passport')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('phone1')->nullable($value = true);
            $table->string('phone2')->nullable($value = true);
            $table->bigInteger('country')->nullable($value = true);
            $table->bigInteger('town')->nullable($value = true);
            $table->bigInteger('sub_county')->nullable($value = true);
            $table->decimal('land_size')->nullable($value = true);
            $table->integer('gender')->nullable($value = true);
            $table->date('date_of_birth')->nullable($value = true);
            $table->text('address')->nullable($value = true);
            $table->text('description')->nullable($value = true);
            $table->integer('channel')->default(1);
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
        Schema::dropIfExists('farmers');
    }
}
