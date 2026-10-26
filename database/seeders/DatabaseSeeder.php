<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Every seeder only adds missing rows, so this is safe to run on each deploy. */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            ProductSeeder::class,
            CatalogProductSeeder::class,
            ArticleSubjectSeeder::class,
            ArticleSeeder::class,
            PageSeoSeeder::class,
            ExternalTrustedLinkSeeder::class,
            CommentSeeder::class,
        ]);

        // ~1,300 provinces/cities: only on the first install.
        if (! Province::query()->exists()) {
            $this->call(IranLocationSeeder::class);
        }
    }
}
