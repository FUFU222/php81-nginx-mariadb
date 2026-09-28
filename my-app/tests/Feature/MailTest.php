<?php

namespace Tests\Feature;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * 会員登録すると、その本人宛にWelcomeMailが送信されること
     */
    public function test_welcome_mail_is_sent_on_registration(): void
    {
        Mail::fake();

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'welcome-mail-test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect();

        $user = User::where('email', 'welcome-mail-test@example.com')->firstOrFail();

        Mail::assertQueued(WelcomeMail::class, function (WelcomeMail $mail) use ($user) {
            return $mail->user->is($user);
        });
    }

    /**
     * 会員登録に失敗した場合は、WelcomeMailが送信されないこと
     */
    public function test_welcome_mail_is_not_sent_when_registration_fails(): void
    {
        Mail::fake();

        $this->post('/register', [
            'name' => 'Test User',
            'email' => 'not-an-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        Mail::assertNothingQueued();
    }
}
