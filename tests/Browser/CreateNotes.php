<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class CreateNotes extends DuskTestCase
{
    /**
     * Test create note after login.
     * @group notes
     */
    public function test_user_can_create_note()
    {
        $user = User::factory()->create([
            'email' => 'user' . uniqid() . '@mail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/create-note')
                ->screenshot('after-visit-create')
                ->waitFor('input[name=title]', 5)
                ->type('title', 'Catatan Dusk')
                ->type('description', 'Isi catatan otomatis oleh Dusk')
                ->press('.btn-submit-note')
                ->screenshot('create-note-debug');
        });
    }
}