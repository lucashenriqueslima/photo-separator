<?php

namespace App\Livewire\Collections;

use App\Livewire\Forms\Collections\CollectionShowForm;
use App\Models\Collection;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Component;

class CollectionShow extends Component
{
    use WithFileUploads;

    public CollectionShowForm $form;
    public Collection $collection;

    #[Rule(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    public function uploadIndentification()
    {

    }

    public function render()
    {
        return view('livewire.collections.collection-show', [
            'collection' => $this->collection,
        ]);
    }

}
