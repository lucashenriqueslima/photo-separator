<?php

namespace App\Livewire\Collections;

use App\Models\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionIndex extends Component
{

    use WithPagination;

    public string $search = '';

    #[Computed()]
    public function collections() 
    {
        return Collection::searchByColumns(['title'], $this->search)
            ->paginate(10);
    }
    public function render()
    {
        return view('livewire.collections.collection-index');
    }
}
