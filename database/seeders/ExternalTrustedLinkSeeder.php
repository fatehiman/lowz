<?php

namespace Database\Seeders;

use App\Models\ExternalTrustedLink;
use Illuminate\Database\Seeder;

class ExternalTrustedLinkSeeder extends Seeder
{
    /**
     * Starter list. firstOrCreate by url, so re-running never overwrites a
     * row that was edited by hand in the DB.
     */
    public function run(): void
    {
        $links = [
            ['name' => 'سازمان غذا و دارو', 'url' => 'https://www.fda.gov.ir'],
            ['name' => 'سازمان ملی استاندارد ایران', 'url' => 'https://www.inso.gov.ir'],
            ['name' => 'وزارت بهداشت، درمان و آموزش پزشکی', 'url' => 'https://behdasht.gov.ir'],
            ['name' => 'انستیتو تحقیقات تغذیه‌ای و صنایع غذایی کشور', 'url' => 'https://nnftri.sbmu.ac.ir'],
            ['name' => 'ویکی‌پدیای فارسی', 'url' => 'https://fa.wikipedia.org'],
            ['name' => 'وزارت میراث فرهنگی، گردشگری و صنایع دستی', 'url' => 'https://www.mcth.ir'],
        ];

        foreach ($links as $link) {
            ExternalTrustedLink::query()->firstOrCreate(['url' => $link['url']], $link);
        }
    }
}
