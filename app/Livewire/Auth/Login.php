<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{

    public string $email;
    public string $password;
    
    #[Title('Entrar')]
    public function render()
    {
        return view('livewire.auth.login');
    }
}
