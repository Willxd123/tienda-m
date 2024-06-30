<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditarPerfil extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $email;
    public $password;
    public $photo; // Rename profile_photo_path to photo for consistency with Fortify example

    protected $awsRuta = 'https://laravel-f.s3.amazonaws.com/';

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        // Assign $photo to the existing profile photo path
        $this->photo = $user->profile_photo_path;
    }

    public function actualizar()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|max:1024', // Adjust max file size as needed
        ]);

        $imageUrl = $this->user->profile_photo_path;

        if ($this->photo && $this->photo->isValid()) {
            if ($this->user->profile_photo_path) {
                $oldImagePath = str_replace($this->awsRuta, '', $this->user->profile_photo_path);
                Storage::delete($oldImagePath);
            }

            $imageRuta = $this->photo->storePublicly('profile_photos');
            $imageUrl = $this->awsRuta . $imageRuta;
        }

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
            'profile_photo_path' => $imageUrl,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Excelente',
            'text' => 'El usuario fue actualizado correctamente',
        ]);

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.editar-perfil');
    }
}
