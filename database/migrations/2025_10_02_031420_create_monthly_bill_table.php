<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('monthly_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->string('month'); // format: YYYY-MM
            $table->decimal('amount', 12, 2);
            $table->date('due_date')->nullable();
            $table->string('status')->default('unpaid');
            $table->string('payment_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('monthly_bills');
    }
};
