<?php

namespace Tests\Feature;

use App\Http\Middleware\UnderConstruction;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnderConstructionTest extends TestCase
{
    use RefreshDatabase;

    protected bool $underConstruction = true;

    protected function setUp(): void
    {
        parent::setUp();
        config(['shop.preview_token' => 'secret-token']);
    }

    public function test_closed_by_default_for_visitors_and_crawlers(): void
    {
        $this->get('/')->assertStatus(503)
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('به‌زودی باز می‌شود');
        $this->get('/shop')->assertStatus(503);
        $this->get('/sitemap.xml')->assertStatus(503);
        $this->get('/robots.txt')->assertOk()->assertSee('Disallow: /');
        $this->get('/up')->assertOk();
    }

    public function test_preview_link_opens_the_site_but_keeps_noindex(): void
    {
        $this->get('/preview/wrong')->assertNotFound();

        $this->get('/preview/secret-token')->assertRedirect(route('home'))
            ->assertCookie(UnderConstruction::COOKIE, UnderConstruction::cookieValue(), false);

        $this->withUnencryptedCookie(UnderConstruction::COOKIE, UnderConstruction::cookieValue())
            ->get('/')
            ->assertOk()
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow')
            ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
            ->assertSee('preview-band', false);
    }

    public function test_allowed_ip_sees_the_site(): void
    {
        Setting::query()->create(['key' => 'maintenance_ips', 'value' => "10.0.0.0/8 # office"]);

        $this->withServerVariables(['REMOTE_ADDR' => '10.1.2.3'])->get('/')->assertOk();
        $this->withServerVariables(['REMOTE_ADDR' => '11.1.2.3'])->get('/')->assertStatus(503);
    }

    public function test_command_turns_the_mode_off(): void
    {
        $this->artisan('site:construction', ['action' => 'off'])->assertSuccessful();

        $this->get('/')->assertOk();
        $this->get('/robots.txt')->assertSee('Sitemap:');
    }
}
