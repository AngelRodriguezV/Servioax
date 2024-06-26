<?php

namespace App\Livewire\Proveedor;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class Ine extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]
    public $photo;

    public $img_defaut;

    public function mount()
    {
        $user = Auth::user();
        if ($user->documento->url_ine != null) {
            $this->img_defaut = $user->documento->url_ine;
        }
        else
        {
            $this->img_defaut = 'svg/user.svg';
        }
    }

    public function updatePhoto()
    {
        if ($this->photo) {
            $url = Storage::disk('public')->put('ine', $this->photo);

            if (Auth::user()->documento->url_ine != null) {
                Storage::disk('public')->delete(Auth::user()->documento->url_ine);
            }
            Auth::user()->documento->update([
                'url_ine' => $url
            ]);

            $this->dispatch('saved');
        }
    }

    public function render()
    {
        return view('livewire.proveedor.ine');
    }
}
