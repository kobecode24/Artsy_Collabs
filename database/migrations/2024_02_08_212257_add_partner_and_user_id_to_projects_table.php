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
            Schema::table('projects', function (Blueprint $table) {
                $table->foreignId('partner_id')->nullable()->constrained()->onDelete('set null');

                $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');

                    $table->dropConstrainedForeignId('partner_id');
            });
        }
    };
