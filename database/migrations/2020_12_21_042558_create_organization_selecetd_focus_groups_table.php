<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationSelecetdFocusGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_selecetd_focus_areas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization')->nullable($value = true);
            $table->bigInteger('focus_group')->nullable($value = true);
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
        Schema::dropIfExists('organization_selecetd_focus_areas');
    }
}
