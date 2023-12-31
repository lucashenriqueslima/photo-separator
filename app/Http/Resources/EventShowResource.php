<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->eventStatus->title,
            'title' => $this->title,
            'description' => $this->description,
            'place' => $this->place,
            'localization' => $this->localization,
            'start' => $this->start->format('d/m/Y h:i'),
            'end' => $this->end->format('d/m/Y h:i')
        ];
    }
}
