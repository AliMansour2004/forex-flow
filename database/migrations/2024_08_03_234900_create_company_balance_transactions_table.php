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
        Schema::create('company_balance_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by_user_id');
            $table->unsignedBigInteger('our_company_account_id');
            $table->float('amount');
            $table->string('reference_id');
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('our_company_account_id')->references('id')->on('our_company_money_accounts')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_balance_transactions');
    }
};
