<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Note;

class EditNotes extends DuskTestCase
{
    /**
     * Test edit note after login.
     * @group notes
     */
    public function test_user_can_edit_note()
    {
        $user = User::factory()->create([
            'email' => 'user' . uniqid() . '@mail.com',
            'password' => bcrypt('123'),
            'email_verified_at' => now(),
        ]);

        // Buat note milik user
        $note = Note::create([
            'penulis_id' => $user->id,
            'judul' => 'Judul Lama',
            'isi' => 'Isi lama',
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', '123')
                ->press('button[type=submit]')
                ->assertPathIs('/dashboard')
                ->visit('/edit-note-page/' . $note->id)
                ->screenshot('edit-note-debug')
                ->waitFor('input[name=judul]', 5)
                ->type('judul', 'Judul Baru')
                ->type('isi', 'Isi baru hasil edit Dusk')
                ->press('button[type=submit]');
        });
    }
}