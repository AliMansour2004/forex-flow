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
        Schema::create('brokers_members_bonuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('broker_id');
            $table->integer('member_count');
            $table->float('bonus_per_member_per_month');
            $table->date('entitlement_at');
            $table->date('next_entitlement_at');
            $table->float('entitlement_amount');
            $table->timestamps();

            $table->foreign('broker_id')->references('id')->on('users')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brokers_members_bonuses');
    }
};
