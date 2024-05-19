<?php

namespace App\Livewire;

use Livewire\Component;

class Header extends Component
{
    public function markAllAsRead()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.header');
    }
}
