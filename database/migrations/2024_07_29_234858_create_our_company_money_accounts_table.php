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
        Schema::create('our_company_money_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('money_transfer_company_id');
            $table->unsignedBigInteger('added_by_user_id')->nullable();
            $table->string('name');
            $table->string('phone_number');
            $table->timestamps();

            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('money_transfer_company_id')->references('id')->on('money_transfer_companies')->onDelete('restrict');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_company_money_accounts');
    }
};
