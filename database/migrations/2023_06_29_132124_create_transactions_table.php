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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unSignedBigInteger('member_id');
            $table->string('transaction_type');
            $table->decimal('amount', 10, 2);
            $table->string('status');
            $table->string('comment');
            $table->date('date');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('sacco_members')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }


};
