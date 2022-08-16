<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name')->nullable($value = true);
            $table->string('email')->nullable($value = true);
            $table->string('telephone')->nullable($value = true);
            $table->text('logo')->nullable($value = true);
            $table->bigInteger('country')->nullable($value = true);
            $table->bigInteger('county')->nullable($value = true);
            $table->bigInteger('sub_county')->nullable($value = true);
            $table->string('registration_no')->nullable($value = true);
            $table->date('date_of_registration')->nullable($value = true);
            $table->text('address')->nullable($value = true);
            $table->text('website')->nullable($value = true);
            $table->text('organization_profile')->nullable($value = true);
            $table->string('contact_person_name')->nullable($value = true);
            $table->string('contact_person_telephone')->nullable($value = true);
            $table->string('contact_person_email')->nullable($value = true);
            $table->string('contact_person_position')->nullable($value = true);
            $table->integer('active')->default(1);
            $table->integer('order')->nullable($value = true);
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
        Schema::dropIfExists('organizations');
    }
}
