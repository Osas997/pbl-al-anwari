<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Santri\Profile;
use App\Models\Santri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ChangePassword extends TestCase
{
    use RefreshDatabase;

    protected Santri $santri;

    protected function setUp(): void
    {
        parent::setUp();

        $this->santri = $this->createSantri([
          'nama_santri' => 'Budi'
        ]);
    
        $this->actingAs($this->santri);
    }

    protected function createSantri(array $attributes = [])
    {
        return Santri::factory()->create($attributes);
    }

   /** @test */
   public function it_validates_password_fields()
   {
       // Validasi untuk current_password
       Livewire::test(Profile::class)
           ->set('current_password', '') 
           ->call('changePassword')
           ->assertHasErrors(['current_password' => 'Password saat ini harus diisi']);

       Livewire::test(Profile::class)
           ->set('current_password', 'wrong_password') 
           ->set('password', 'new_password')
           ->set('password_confirmation', 'new_password')
           ->call('changePassword')
           ->assertHasErrors(['current_password' => 'Password saat ini salah.']);

       // Validasi untuk password
       Livewire::test(Profile::class)
           ->set('password', '') 
           ->call('changePassword')
           ->assertHasErrors(['password' => 'Password harus diisi']);

       Livewire::test(Profile::class)
           ->set('password', 'short') 
           ->call('changePassword')
           ->assertHasErrors(['password' => 'Password minimal 8 karakter']);

       Livewire::test(Profile::class)
           ->set('password', 'new_password')
           ->set('password_confirmation', 'different_password') 
           ->call('changePassword')
           ->assertHasErrors(['password' => 'Konfirmasi Password tidak sama']);

       // Validasi untuk password yang valid
       Livewire::test(Profile::class)
           ->set('current_password', 'current_password') // Valid
           ->set('password', 'new_password') // Valid
           ->set('password_confirmation', 'new_password') // Valid
           ->call('changePassword')
           ->assertStatus(200);
   }

   /** @test */
   public function it_changes_password_successfully()
   {
       Livewire::test(Profile::class)
           ->set('current_password', 'password') // Valid
           ->set('password', 'passwordbaru') // Valid
           ->set('password_confirmation', 'passwordbaru') // Valid
           ->call('changePassword');

       // Verifikasi bahwa password telah diubah
       $this->santri->refresh();
       $this->assertTrue(Hash::check('passwordbaru', $this->santri->password));
   }

   /** @test */
   public function it_does_not_change_password_if_current_password_is_incorrect()
   {
       Livewire::test(Profile::class)
           ->set('current_password', 'wrong_password') 
           ->set('password', 'new_password') 
           ->set('password_confirmation', 'new_password') 
           ->call('changePassword');

       // Verifikasi bahwa password tidak berubah
       $this->santri->refresh();
       $this->assertTrue(Hash::check('password', $this->santri->password));
       $this->assertFalse(Hash::check('new_password', $this->santri->password));
   }
} 
