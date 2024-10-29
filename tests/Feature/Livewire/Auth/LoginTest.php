<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\Login;
use App\Models\Admin;
use App\Models\Catering;
use App\Models\Diniyyah;
use App\Models\Santri;
use App\Models\Syahriyyah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_login_page()
    {
        $this->get('/login')
            ->assertStatus(200)
            ->assertSeeLivewire('auth.login');
    }

    public function test_admin_can_login()
    {
        $admin = Admin::factory()->create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        Livewire::test(Login::class)
            ->set('username', 'admin')
            ->set('password', 'admin')
            ->call('authenticate');

        $this->assertTrue(Auth::guard('admin')->check());
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_user_can_login()
    {
        $user = $this->createUser();

        Livewire::test(Login::class)
            ->set('username', '351016040604000808')
            ->set('password', 'password')
            ->call('authenticate');

        $this->assertTrue(Auth::guard('web')->check());
        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_shows_validation_errors()
    {
        Livewire::test(Login::class)
            ->set('username', '')
            ->set('password', '')
            ->call('authenticate')
            ->assertHasErrors(['username', 'password']);
    }

    public function test_shows_login_failed_invalid_username()
    {
        Livewire::test(Login::class)
            ->set('username', 'wrongusername')
            ->set('password', 'password')
            ->call('authenticate')
            ->assertSee('Username Atau Password Anda Salah');
    }

    public function test_shows_login_failed_invalid_password()
    {
        Livewire::test(Login::class)
            ->set('username', '351016040604000808')
            ->set('password', 'wrongpassword')
            ->call('authenticate')
            ->assertSee('Username Atau Password Anda Salah');
    }

    public function test_throttle_login_attempts()
    {
        for ($i = 0; $i < 5; $i++) {
            Livewire::test(Login::class)
                ->set('username', 'wronguser')
                ->set('password', 'wrongpassword')
                ->call('authenticate');
        }

        Livewire::test(Login::class)
            ->set('username', 'wronguser')
            ->set('password', 'wrongpassword')
            ->call('authenticate')
            ->assertSee('Terlalu banyak login ,Coba lagi dalam');
    }

    public function test_can_login_after_throttle_period()
    {
        for ($i = 0; $i < 5; $i++) {
            Livewire::test(Login::class)
                ->set('username', 'wronguser')
                ->set('password', 'wrongpassword')
                ->call('authenticate');
        }

        // Simulate waiting for the throttle period to expire
        $this->travel(1)->minutes(); // Adjust this as needed


        $admin = Admin::factory()->create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        Livewire::test(Login::class)
            ->set('username', 'admin')
            ->set('password', 'admin')
            ->call('authenticate');

        $this->assertTrue(Auth::guard('admin')->check());
    }

    /** @test */
    public function test_login_gagal_username_empty()
    {
        Livewire::test(Login::class)
            ->set('username', '')
            ->set('password', '123456')
            ->call('authenticate')
            ->assertHasErrors(['username' => 'required']);
    }

    /** @test */
    public function test_login_gagal_password_empty()
    {
        Livewire::test(Login::class)
            ->set('username', '123456789012345')
            ->set('password', '')
            ->call('authenticate')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    public function test_login_failed_username_less_than_3_digits()
    {
        Livewire::test(Login::class)
            ->set('username', '12')
            ->set('password', '1233456')
            ->call('authenticate')
            ->assertHasErrors(['username']);
    }

    /** @test */
    public function test_login_failed_password_less_than_4_digits()
    {
        Livewire::test(Login::class)
            ->set('username', '12345678901')
            ->set('password', '222')
            ->call('authenticate')
            ->assertHasErrors(['password']);
    }

    public function createUser()
    {
        Syahriyyah::create([
            "jenis_domisili" => "Mukim",
            "biaya" => 100_000
        ]);

        Catering::create([
            "jumlah_catering" => 1,
            "biaya" => 50_000
        ]);

        $diniyah = Diniyyah::create([
            "nama_tingkatan" => "GUS",
            "kelas" => "1",
        ]);

        $user = Santri::factory()->create([
            'nama_santri' => 'Ahmad Rizki',
            'nis' => '351016040604000808',
            'password' => bcrypt('password'),
            'no_nik' => '9876543210123456',
            'no_hp' => '08123456789',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '2005-06-15',
            'alamat' => 'Jl. Raya No. 123, Bandung',
            'nama_ayah' => 'Budi Santoso',
            'nama_ibu' => 'Siti Aminah',
            'status' => 'Aktif',
            'id_syahriyyah' => 1,
            'id_catering' => 1,
            'tahun_angkatan' => 2023,
            'id_diniyyah' => $diniyah->id,
        ]);

        return $user;
    }
}