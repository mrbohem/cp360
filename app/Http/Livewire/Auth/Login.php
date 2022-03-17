<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $hideSideBar = true;
    public $email = "";
    public $password = "";

    public function mount()
    {
        if (Auth::check()) {
            redirect()->route('admin.create-form');
        }
    }

    public function submit()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(array('email' => $this->email, 'password' => $this->password))) {
            session()->flash('message', "You are Login successful.");
            redirect()->route('admin.create_form');
        }
        else {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
