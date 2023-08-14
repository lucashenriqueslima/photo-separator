<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;

class EventShow extends Component
{

    public Event $event;
    
    

    public function render()
    {
        return view('livewire.events.event-show');
    }
}
