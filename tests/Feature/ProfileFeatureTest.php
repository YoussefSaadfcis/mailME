<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProfileFeatureTest extends TestCase
{
    use RefreshDatabase;

    #[Test]    
    public function guest_users_cannot_access_character_page()
    {
        $response = $this->get(route('user.character'));
        $response->assertRedirect(route('signin.get'));
    }

    #[Test]    
    public function authenticated_user_can_view_character_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.character'));

        $response->assertStatus(200);
        $response->assertViewIs('user.profile.profile'); // adjust if your blade file has another name
    }

    #[Test]    
    public function authenticated_user_can_submit_character_data()
    {
        $user = User::factory()->create();

        $data = [
            'mood' => 'Optimistic',
            'motivation' => 'Growth & Success',
            'religion' => 'Islam',
            'allow_religion_use' => true,
            'about' => 'I love to learn and grow every day.',
        ];

        $response = $this->actingAs($user)->post(route('user.character'), $data);

        $response->assertRedirect(); // should redirect after success
        $this->assertDatabaseHas('user_characters', [
            'user_id' => $user->id,
            'mood' => 'Optimistic',
            'motivation' => 'Growth & Success',
        ]);
    }


}
