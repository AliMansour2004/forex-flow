<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('broker_receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('our_company_money_account_id');
            $table->unsignedBigInteger('broker_id');
            $table->unsignedBigInteger('added_by_user_id');
            $table->float('amount');
            $table->date('receipt_at');
            $table->string('transaction_id');

            $table->timestamps();

            $table->foreign('broker_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('our_company_money_account_id')->references('id')->on('our_company_money_accounts')->onDelete('restrict');
            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brokers_receipts');
    }
};
