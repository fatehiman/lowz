<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * The site is public now: replace the old demo texts of two settings.
 * Only rows that still hold the old seeded text are changed (edited values stay).
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('settings')->where('key', 'seller_info')
            ->where('value', 'عطاری لوز (اطلاعات فروشنده نمایشی است)')
            ->update(['value' => 'عطاری لوز']);

        DB::table('settings')->where('key', 'proforma_payment_note')
            ->where('value', 'این پیش‌فاکتور نمونه است. پس از اتصال درگاه پرداخت واقعی، شماره حساب فروشگاه اینجا نوشته می‌شود. مبالغ همگی به تومان است.')
            ->update(['value' => 'مبالغ همگی به تومان است.']);
    }

    public function down(): void
    {
        // Nothing to restore: the old text was demo only.
    }
};
