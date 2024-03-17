<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Login')]
class Login extends Component
{
    #[Validate('required|string|min:3')]
    public string $username = '';

    #[Validate('required|string|min:4')]
    public string $password = '';


    public function authenticate()
    {
        $this->validate();

        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            event(new Lockout(request()));

            $seconds = RateLimiter::availableIn($this->throttleKey());
            session()->flash('error', 'Terlalu banyak login ,Coba lagi dalam ' . $seconds . " seconds");

            return;
        }

        if (Auth::guard('admin')->attempt($this->only(['username', 'password']))) {

            RateLimiter::clear($this->throttleKey());

            Session::regenerate();

            $this->redirectIntended(default: '/dashboard', navigate: true);
        }

        RateLimiter::hit($this->throttleKey());
        session()->flash('error', 'Username Atau Password Anda Salah');
        return;
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username) . '|' . request()->ip());
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
