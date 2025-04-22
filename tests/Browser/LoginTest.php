<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test Registrasi.
     * @group Login
     */
    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/') 
                ->assertSee('Enterprise Application Development') 
                ->clickLink('Log in') 
                ->assertPathIs('/login') 
                ->type('email', 'admin@mail.com') 
                ->type('password', '123') 
                ->press('LOG IN') 
                ->pause(2000) 
                ->assertPathIs('/dashboard');
        });
    }
}