<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmer_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('farmer_id')->nullable($value = true);
            $table->bigInteger('document_type_id')->nullable($value = true);
            $table->text('serial_no')->nullable($value = true);
            $table->text('document_upload')->nullable($value = true);
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
        Schema::dropIfExists('farmer_documents');
    }
}
