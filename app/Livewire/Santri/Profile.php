<?php

namespace App\Livewire\Santri;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
class Profile extends Component
{

    public $current_password;
    public $password;
    public $password_confirmation;

    public function changePassword()
    {
        // dd($this->all());
        $this->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'password.required' => 'Password harus diisi',
            'password.confirmed' => 'Konfirmasi Password tidak sama',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        try {
            $user = Auth::guard('web')->user();

            if (!Hash::check($this->current_password, $user->password)) {
                $this->addError('current_password', 'Password saat ini salah.');
                return;
            }

            Auth::user()->update([
                'password' => Hash::make($this->password),
            ]);

            $this->reset('current_password', 'password', 'password_confirmation');

            flash('Password Berhasil Diubah', 'success');
        } catch (\Throwable $th) {
            flash("Password gagal diubah" . $th->getMessage(), 'error');
        }
    }

    public function render()
    {
        return view('livewire.santri.profile');
    }
}
