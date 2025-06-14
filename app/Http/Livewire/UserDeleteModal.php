<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserDeleteModal extends Component
{
    public $showModal = false;
    public $userId;

    protected $listeners = ['openDeleteUserModal'];

    public function openDeleteUserModal($userId)
    {
        $this->userId = $userId;
        $this->showModal = true;
    }

    public function deleteUser()
    {
        $user = User::find($this->userId);

        if ($user) {
            $user->delete();
            session()->flash('success', 'Usuario eliminado correctamente.');
        } else {
            session()->flash('error', 'El usuario no existe o ya fue eliminado.');
        }

        $this->reset(['showModal', 'userId']);

        return redirect()->route('users.index');
    }


    public function render()
    {
        return view('livewire.user-delete-modal');
    }
}
