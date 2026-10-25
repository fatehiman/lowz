<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ProductCommentTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        Http::fake();
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

        $this->product = Product::create([
            'slug' => 'test-product', 'name' => 'زعفران تست', 'short_description' => 'تست', 'description' => 'توضیح تست.', 'price' => 53000,
            'min_quantity' => 12, 'quantity_step' => 1, 'image' => 'images/products/x.jpg', 'is_active' => true,
        ]);
    }

    private function post_(array $data, string $captcha = '1234')
    {
        return $this->withSession(['comment_captcha' => $captcha])
            ->post(route('product.comment', $this->product), $data + [
                'name' => 'سارا', 'email' => 'Sara@Example.com', 'rating' => 4,
                'body' => 'خیلی خوش‌عطر و تازه بود', 'captcha' => '1234',
            ]);
    }

    public function test_page_shows_form_and_no_stars_without_accepted_comments(): void
    {
        $this->get(route('product.show', $this->product))
            ->assertOk()
            ->assertSee('نظر خود را بنویسید')
            ->assertDontSee('aggregateRating');
    }

    public function test_valid_comment_is_saved_unaccepted(): void
    {
        $this->post_([])->assertRedirect(route('product.show', $this->product).'#comments')
            ->assertSessionHas('comment_success');

        $c = Comment::sole();
        $this->assertFalse($c->is_accepted);
        $this->assertSame('sara@example.com', $c->email);
        $this->assertSame(4, $c->rating);
        Http::assertNothingSent();

        // Not accepted yet -> not shown.
        $this->get(route('product.show', $this->product))->assertDontSee('خیلی خوش‌عطر');
    }

    public function test_persian_digits_in_captcha_are_accepted(): void
    {
        $this->post_(['captcha' => '۱۲۳۴'])->assertSessionHasNoErrors();
        $this->assertSame(1, Comment::count());
    }

    public function test_wrong_captcha_is_rejected(): void
    {
        $this->post_(['captcha' => '9999'])->assertSessionHasErrors('captcha');
        $this->assertSame(0, Comment::count());
        Http::assertNothingSent();
    }

    public function test_missing_fields_are_rejected(): void
    {
        $this->post_(['email' => 'not-an-email', 'rating' => 6, 'name' => ''])
            ->assertSessionHasErrors(['email', 'rating', 'name']);
        $this->assertSame(0, Comment::count());
    }

    public function test_honeypot_is_silently_dropped(): void
    {
        $this->post_(['website' => 'http://spam'])->assertSessionHas('comment_success');
        $this->assertSame(0, Comment::count());
    }

    public function test_accepted_comments_are_shown_with_google_rating(): void
    {
        $this->product->comments()->create(['name' => 'علی', 'email' => 'a@b.c', 'rating' => 5, 'body' => 'عالی بود', 'is_accepted' => true]);
        $this->product->comments()->create(['name' => 'مریم', 'email' => 'm@b.c', 'rating' => 4, 'body' => 'خوب بود', 'is_accepted' => true]);
        $this->product->comments()->create(['name' => 'اسپم', 'email' => 's@b.c', 'rating' => 1, 'body' => 'تبلیغ', 'is_accepted' => false]);

        $html = $this->get(route('product.show', $this->product))->assertOk()
            ->assertSee('عالی بود')->assertSee('خوب بود')->assertDontSee('تبلیغ')
            ->getContent();

        preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);
        $product = collect($m[1])->map(fn ($j) => json_decode($j, true))->firstWhere('@type', 'Product');
        $this->assertSame('4.5', $product['aggregateRating']['ratingValue']);
        $this->assertSame(2, $product['aggregateRating']['reviewCount']);
        $this->assertCount(2, $product['review']);
    }

    public function test_rate_limit_uses_cloudflare_visitor_ip(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->withHeader('CF-Connecting-IP', '5.5.5.5')->post_([])->assertRedirect();
        }
        $this->withHeader('CF-Connecting-IP', '5.5.5.5')->post_([])->assertStatus(429);
        // Another visitor behind the same Cloudflare edge is not blocked.
        $this->withHeader('CF-Connecting-IP', '6.6.6.6')->post_([])->assertRedirect();
        $this->assertSame('6.6.6.6', Comment::latest('id')->first()->ip);
    }

    public function test_comment_captcha_image(): void
    {
        $this->get(route('comment.captcha'))->assertOk()->assertHeader('Content-Type', 'image/png')
            ->assertSessionHas('comment_captcha');
    }
}
