<?php

namespace Tests\Browser;

use App\User;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /** @test */
    public function can_an_unauthenticated_user_be_redirected_to_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/panel')
                    ->assertPathIs('/login');
        });
    }

    /** @test */
    public function can_an_user_with_email_verification_login_and_can_access_to_panel_view()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => Carbon::now()
        ]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit('/panel')
                ->assertPathIs('/panel');
            $browser->assertAuthenticated();
        });
    }

    /** @test */
    public function can_user_with_no_email_verification_login_and_be_redirected_to_email_verify_page()
    {
        $user = factory(User::class)->create([
            'email_verified_at' => null
        ]);

        $this->browse(function (Browser $browser) use($user) {
            $browser->loginAs($user)
                ->visit('/panel')
                ->assertPathIs('/email/verify');
            $browser->assertAuthenticated();
        });
    }
}
