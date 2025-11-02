<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test; 
class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_sign_up_successfully()
    {
        $response = $this->post(route('signup.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birthdate' => '1995-05-12',
        ]);

        $response->assertRedirect(); // redirect after register
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }

    #[Test]
    public function user_cannot_sign_up_with_invalid_email()
    {
        $response = $this->post(route('signup.store'), [
            'name' => 'John',
            'email' => 'not-an-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birthdate' => '1995-05-12',
        ]);

        $response->assertSessionHasErrors('email');
    }

    #[Test]
    public function user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('signin.post'), [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('user.home'));
        $this->assertAuthenticatedAs($user);
    }


    #[Test]
    public function user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('signin.post'), [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}