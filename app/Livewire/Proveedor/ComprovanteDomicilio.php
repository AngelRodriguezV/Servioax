<?php

namespace App\Livewire\Proveedor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class ComprovanteDomicilio extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]
    public $photo;

    public $img_defaut;

    public function mount()
    {
        $user = Auth::user();
        if ($user->documento->url_domicilio != null) {
            $this->img_defaut = $user->documento->url_domicilio;
        }
        else
        {
            $this->img_defaut = 'svg/user.svg';
        }
    }

    public function updatePhoto()
    {
        if ($this->photo) {
            $url = Storage::disk('public')->put('domicilio', $this->photo);

            if (Auth::user()->documento->url_domicilio != null) {
                Storage::disk('public')->delete(Auth::user()->documento->url_domicilio);
            }
            Auth::user()->documento->update([
                'url_domicilio' => $url
            ]);

            $this->dispatch('saved');
        }
    }

    public function render()
    {
        return view('livewire.proveedor.comprovante-domicilio');
    }
}
