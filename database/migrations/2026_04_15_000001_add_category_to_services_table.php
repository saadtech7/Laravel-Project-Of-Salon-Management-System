<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('category')->default('men')->after('is_active'); // men | women
            $table->decimal('rating', 3, 2)->default(4.80)->after('category');
            $table->integer('review_count')->default(0)->after('rating');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['category', 'rating', 'review_count']);
        });
    }
};
