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
        Schema::create('sacco_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sacco_member_id');
            $table->unsignedBigInteger('sacco_id');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('sacco_members')->onDelete('cascade');
            $table->foreign('sacco_id')->references('id')->on('saccos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacco_users');
    }
};
