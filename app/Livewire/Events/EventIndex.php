<?php

namespace App\Livewire\Events;
use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Component;

#[Title('Eventos')]
class EventIndex extends Component
{
    use WithPagination;

    public string $search = '';

    #[Computed()]
    public function events() 
    {
        return Event::with('eventStatus')
            ->searchByColumns(['title', 'description', 'place', 'localization'], $this->search)
            ->paginate(10);
    }

}
