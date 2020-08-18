<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function can_user_with_email_verified_at_login()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => Carbon::now()
        ]);

        $response = $this->post('/login', [
            'email'     => $user->email,
            'password'  => 'Abc1234$'
        ]);

        $this->assertAuthenticated();
        $response->assertLocation('/panel');
    }
}
