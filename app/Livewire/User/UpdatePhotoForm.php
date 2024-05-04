<?php

namespace App\Livewire\User;

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class UpdatePhotoForm extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')]
    public $photo;

    public $img_defaut;

    public function mount()
    {
        $user = Auth::user();
        if ($user->image) {
            $this->img_defaut = $user->image->url;
        }
        else
        {
            $this->img_defaut = 'svg/user.svg';
        }
    }

    public function updatePhoto()
    {
        if ($this->photo) {
            $url = Storage::disk('public')->put('photo', $this->photo);

            if (Auth::user()->image) {
                Storage::disk('public')->delete(Auth::user()->image->url);

                Auth::user()->image->update([
                    'url' => $url
                ]);
            } else {
                Image::create([
                    'url' => $url,
                    'imageable_id' => Auth::user()->id,
                    'imageable_type' => User::class
                ]);
            }

            $this->dispatch('saved');
        }
    }

    public function render()
    {
        return view('livewire.user.update-photo-form');
    }
}
