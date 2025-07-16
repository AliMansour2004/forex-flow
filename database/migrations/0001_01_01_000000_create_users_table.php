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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('added_by_user_id')->nullable();
            $table->string('first_name', 191); // Limit length
            $table->string('middle_name', 191); // Limit length
            $table->string('last_name', 191); // Limit length
            $table->string('phone')->unique();
            $table->string('user_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->float('balance')->default(0)->comment('only for brokers');
            $table->boolean('is_active')->default(1)->comment('0: not active(cannot login), 1: active');
//            $table->boolean('is_account_opened');
            $table->boolean('is_our_tbroker_account_open')->default(0)->comment('Trading Broker Account Open');
            $table->string('our_tbroker_server_name')->nullable()->comment('Trading Broker Server Name');
            $table->integer('our_tbroker_account_number')->unique()->nullable()->comment('Trading Broker Account Number');
            $table->timestamps();

            $table->unique(['first_name', 'middle_name', 'last_name', 'phone', 'email'], 'unique_user');

            $table->foreign('parent_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
