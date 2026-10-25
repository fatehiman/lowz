<?php

namespace Tests;

use App\Models\Setting;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    /** Tests see the real site; UnderConstructionTest turns the mode on itself. */
    protected bool $underConstruction = false;

    protected function setUp(): void
    {
        parent::setUp();

        if (! $this->underConstruction && Schema::hasTable('settings')) {
            Setting::query()->updateOrCreate(['key' => 'maintenance_enabled'], ['value' => '0']);
        }
    }
}
