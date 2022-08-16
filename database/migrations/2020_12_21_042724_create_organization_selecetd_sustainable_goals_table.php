<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationSelecetdSustainableGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_selecetd_sustainable_goals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization')->nullable($value = true);
            $table->bigInteger('sustainable_goal')->nullable($value = true);
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
        Schema::dropIfExists('organization_selecetd_sustainable_goals');
    }
}
