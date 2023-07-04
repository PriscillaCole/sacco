<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sacco_id');
            $table->string('name');
            $table->string('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('tin')->nullable()->default(null);
            $table->string('loan_amount')->nullable()->default(null);
            $table->string('purpose')->nullable()->default(null);
            $table->string('guarantor')->nullable()->default(null);
            $table->string('source_of_repayment')->nullable()->default(null);
            $table->string('picture_id')->nullable()->default(null);
            $table->string('are_you_a_member')->nullable()->default(null);
            $table->string('collateral_description')->nullable()->default(null);
            $table->string('term_required')->nullable()->default(null);
            $table->string('status')->nullable()->default(null);
            $table->string('comment')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sacco_id')->references('id')->on('saccos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
