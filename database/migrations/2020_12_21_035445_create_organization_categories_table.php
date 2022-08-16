<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
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
        Schema::dropIfExists('organization_categories');
    }
}
