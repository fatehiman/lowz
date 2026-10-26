<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_show_the_real_address_and_no_phone_social_or_demo_text(): void
    {
        foreach (['/', '/contact', '/about', '/rules'] as $url) {
            $this->get($url)->assertOk()
                ->assertSee('پلاک 386')
                ->assertDontSee('tel:', false)
                ->assertDontSee('footer-social', false)
                ->assertDontSee('سایت نمونه')
                ->assertDontSee('متن نمونه')
                ->assertDontSee('نمایشی');
        }
    }

    public function test_phone_shows_again_when_it_is_configured(): void
    {
        config(['shop.phone' => '021-12345678']);

        $this->get('/contact')->assertOk()->assertSee('021-12345678');
        $this->get('/')->assertOk()->assertSee('tel:02112345678', false);
    }
}
