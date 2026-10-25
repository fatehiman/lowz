<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactSubjectTest extends TestCase
{
    use RefreshDatabase;

    private array $form = ['name' => 'a', 'email' => 'a@b.cd', 'message' => 'سلام', 'captcha' => '7'];

    protected function setUp(): void
    {
        parent::setUp();
        Http::fake();
        Storage::fake('local');
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
    }

    public function test_subject_list_and_preselect_from_query(): void
    {
        $this->get(route('contact'))->assertOk()
            ->assertSeeInOrder(['یک موضوع را انتخاب کنید', 'سوال درباره محصولات', 'موضوعات دیگر'])
            ->assertDontSee('selected', false);

        $this->get(route('contact', ['subject' => 'wholesale']))->assertOk()
            ->assertSee('<option value="wholesale" selected', false);

        // Unknown key -> nothing preselected.
        $this->get(route('contact', ['subject' => 'xyz']))->assertOk()->assertDontSee('selected', false);
    }

    public function test_subject_is_optional_and_validated(): void
    {
        $this->withSession(['contact_captcha' => '7'])->post(route('contact.submit'), $this->form + ['subject' => ''])
            ->assertSessionHas('success');

        $this->withSession(['contact_captcha' => '7'])->post(route('contact.submit'), $this->form + ['subject' => 'xyz'])
            ->assertSessionHasErrors('subject');

        $this->withSession(['contact_captcha' => '7'])->post(route('contact.submit'), $this->form + ['subject' => 'wholesale'])
            ->assertSessionHas('success');
        // Demo site: the message is only stored, nothing is sent out.
        Http::assertNothingSent();
        $this->assertCount(2, Storage::disk('local')->files('contacts'));
    }
}
