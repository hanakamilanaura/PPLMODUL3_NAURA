<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * Test login success with valid credentials.
     * @group login
     */
    public function test_user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin' . uniqid() . '@mail.com',
            'password' => bcrypt('123'),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '123')
                ->press('button[type=submit]')
                ->pause(1000)
                ->assertPathIs('/dashboard');
        });
    }
}