<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\tag;

class TagDeleteModal extends Component
{
    public $showModal = false;
    public $tagId;

    protected $listeners = ['openDeleteTagModal' => 'openModal'];

    public function openModal($tagId)
    {
        $this->tagId = $tagId;
        $this->showModal = true;
    }

    public function deleteTag()
    {
        $tag = Tag::find($this->tagId);

        if ($tag) {
            $tag->delete();

            redirect()->route('tags.index')->with('success', 'Etiqueta eliminada correctamente!');

        }

        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.tag-delete-modal');
    }
}
