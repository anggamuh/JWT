<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ref_fee', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('registration_fee', 12, 2);
            $table->decimal('monthly_fee', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ref_fee');
    }
};
