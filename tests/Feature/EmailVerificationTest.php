<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]

    public function valid_otp_verifies_user_email_successfully()
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        // Create fake OTP record
        $otp = EmailVerification::create([
            'user_id' => $user->id,
            'otp' => '123456',
            'expires_at' => now()->addMinutes(10),
        ]);

        $response = $this->post(route('verify.email.otp', $user->id), [
            'otp' => '123456',
        ]);

        $response->assertRedirect(route('user.home'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);

        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    #[Test]

    public function invalid_otp_fails_verification()
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        EmailVerification::create([
            'user_id' => $user->id,
            'otp' => '123456',
            'expires_at' => now()->addMinutes(10),
        ]);

        $response = $this->post(route('verify.email.otp', $user->id), [
            'otp' => '999999', // wrong OTP
        ]);

        $response->assertSessionHasErrors(['otp']);
        $this->assertNull($user->fresh()->email_verified_at);
    }

    #[Test]

    public function expired_otp_cannot_be_used()
    {
        $user = User::factory()->create(['email_verified_at' => null]);

        EmailVerification::create([
            'user_id' => $user->id,
            'otp' => '123456',
            'expires_at' => now()->subMinutes(5),
        ]);

        $response = $this->post(route('verify.email.otp', $user->id), [
            'otp' => '123456',
        ]);

        $response->assertSessionHasErrors(['otp']);
        $this->assertNull($user->fresh()->email_verified_at);
    }
}
