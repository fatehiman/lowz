<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContactCaptchaTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_captcha_right_and_wrong_answer(): void
    {
        Http::fake();
        Storage::fake('local');
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
        $form = ['name' => 'a', 'email' => 'a@b.cd', 'message' => 'سلام'];

        $this->get(route('contact.captcha'))->assertOk()->assertSessionHas('contact_captcha');

        $this->withSession(['contact_captcha' => '7'])->post(route('contact.submit'), $form + ['captcha' => '8'])
            ->assertSessionHasErrors('captcha');
        $this->withSession(['contact_captcha' => '7'])->post(route('contact.submit'), $form + ['captcha' => '7'])
            ->assertSessionHas('success');
    }
}
