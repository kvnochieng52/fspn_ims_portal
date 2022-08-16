<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name')->nullable($value = true);
            $table->bigInteger('category_id')->nullable($value = true);
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
        Schema::dropIfExists('organization_sub_categories');
    }
}
