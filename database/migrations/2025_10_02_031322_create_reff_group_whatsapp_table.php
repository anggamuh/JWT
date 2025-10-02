    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up(): void {
            Schema::create('ref_group_whatsapp', function (Blueprint $table) {
                $table->id();
                $table->year('year');
                $table->string('link');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }

        public function down(): void {
            Schema::dropIfExists('ref_group_whatsapp');
        }
    };
