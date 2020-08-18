<?php

namespace Tests\Browser;

use Mockery;
use App\User;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends DuskTestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function can_an_user_register_itself()
    {
        $user = factory(User::class)->make();
        
        $this->browse(function (Browser $browser) use($user) {
            Mail::fake();
            Notification::fake();

            $browser->visit('/register')
                    ->assertPresent('input#name[name="name"]')
                    ->assertVisible('input#name[name="name"]')
                    ->assertPresent('input#lastname[name="lastname"]')
                    ->assertVisible('input#lastname[name="lastname"]')
                    ->assertPresent('input#identification[name="identification"]')
                    ->assertVisible('input#identification[name="identification"]')
                    ->assertPresent('input#phone[name="phone"]')
                    ->assertVisible('input#phone[name="phone"]')
                    ->assertPresent('input#country[name="country"]')
                    ->assertVisible('input#country[name="country"]')
                    ->assertPresent('input#email[name="email"]')
                    ->assertVisible('input#email[name="email"]')
                    ->assertPresent('input#password[name="password"]')
                    ->assertVisible('input#password[name="password"]')
                    ->assertPresent('input#password_confirmation[name="password_confirmation"]')
                    ->assertVisible('input#password_confirmation[name="password_confirmation"]')
                    ->type('name', $user->name)
                    ->type('lastname', $user->lastname)
                    ->type('identification', $user->identification)
                    ->type('phone', $user->phone)
                    ->type('country', $user->country)
                    ->type('email', $user->email)
                    ->type('password', 'Abc1234$')
                    ->type('password_confirmation', 'Abc1234$')
                    ->press('Registrar')
                    ->assertPathIs('/email/verify');

            $this->assertDatabaseHas('users', [
                'name'          => $user->name,
                'lastname'      => $user->lastname,
                'identification'=> $user->identification,
                'phone'         => $user->phone,
                'country'       => $user->country,
                'email'         => $user->email,
                'email_verified_at' => null,
            ]);
        });
    }
}
