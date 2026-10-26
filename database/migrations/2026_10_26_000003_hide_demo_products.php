<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * The real catalog (CatalogProductSeeder, sort_order >= 100) replaces the 33 demo products: hide the demo ones.
 * They stay in the database (orders may point to them); set is_active = 1 to show one again.
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->where('sort_order', '<', 100)->update(['is_active' => false]);
    }

    public function down(): void
    {
        DB::table('products')->where('sort_order', '<', 100)->update(['is_active' => true]);
    }
};
