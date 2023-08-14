<?php

namespace App\Livewire\Collections;

use App\Models\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CollectionShow extends Component
{

    public Collection $collection;

    public function render()
    {
        return view('livewire.collections.collection-show', [
            'collection' => $this->collection,
        ]);
    }

}
