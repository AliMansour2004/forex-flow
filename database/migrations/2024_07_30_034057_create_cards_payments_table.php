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
        Schema::create('card_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by_user_id')->nullable();
            $table->unsignedBigInteger('broker_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('our_company_money_account_id')->nullable();
            $table->float('amount');
            $table->float('fees')->nullable();
            $table->integer('duration');
            $table->float('discount')->nullable();
//            $table->float('cost');
            $table->date('purchased_at');
            $table->date('finished_at');
            $table->float('broker_profit_percentage')->nullable();
            $table->float('broker_profit_cost')->nullable();
            $table->float('gross_profit');
            $table->string('transaction_id')->nullable();
            $table->timestamps();

            $table->foreign('our_company_money_account_id')->references('id')->on('our_company_money_accounts')->onDelete('restrict');
            $table->foreign('broker_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
