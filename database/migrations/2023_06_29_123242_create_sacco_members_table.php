<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaccoMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacco_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sacco_id');
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('image');
            $table->string('nationality');
            $table->string('identification_number');
            $table->string('physical_address');
            $table->string('postal_address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('employment_status');
            $table->string('employer_name')->nullable();
            $table->decimal('monthly_income', 8, 2)->nullable();
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('membership_type');
            $table->string('membership_id');
            $table->date('date_of_joining');
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_contact')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('beneficiary_relationship')->nullable();
            $table->string('password');
            $table->timestamps();

            $table->foreign('sacco_id')->references('id')->on('saccos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sacco_members');
    }
}
