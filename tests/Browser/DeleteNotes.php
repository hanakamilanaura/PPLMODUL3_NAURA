<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Note;

class DeleteNotes extends DuskTestCase
{
    /**
     * Test delete note after login.
     * @group notes
     */
    public function test_user_can_delete_note()
    {
        $user = User::factory()->create([
            'email' => 'user' . uniqid() . '@mail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
        ]);

        // Buat note milik user
        $note = Note::create([
            'penulis_id' => $user->id,
            'judul' => 'Judul Dusk',
            'isi' => 'Isi catatan Dusk',
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/note/' . $note->id)
                ->press('#delete-' . $note->id)
                ->assertDontSee($note->judul);
        });
    }
}