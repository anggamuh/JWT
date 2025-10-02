<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type'); // pendaftaran / bulanan
            $table->string('reference_id')->nullable();
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payment');
    }
};
