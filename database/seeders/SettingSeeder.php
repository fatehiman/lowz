<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * firstOrCreate: a deploy runs the seeders again and must never turn
     * "under construction" back on or reset an edited value.
     */
    public function run(): void
    {
        $rows = [
            'seller_info' => 'عطاری لوز (اطلاعات فروشنده نمایشی است)',
            'proforma_payment_note' => 'این پیش‌فاکتور نمونه است. پس از اتصال درگاه پرداخت واقعی، شماره حساب فروشگاه اینجا نوشته می‌شود. مبالغ همگی به تومان است.',
            'min_order_items' => '1',
            'packing_price' => '0',
            'pack_capacity' => '12',
            'vat_percent' => '0',
            // "Under construction" is on after the first install (php artisan site:construction off).
            'maintenance_enabled' => '1',
            'maintenance_ips' => '',
        ];

        foreach ($rows as $key => $value) {
            Setting::query()->firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
