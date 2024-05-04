<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateProfileForm extends Component
{

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    public function mount()
    {
        $user = Auth::user();
        $this->state = array_merge([], $user->withoutRelations()->toArray());
    }

    public function updateProfile()
    {
        Auth::user()->update($this->state);
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.user.update-profile-form');
    }
}
