<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        // $query = $event->all();
        // dd($query->toSql());
        return $event->with('event_status')->get();
        
        // QueryBuilder::for(Event::class)
        // ->allowedFilters('status')
        // ->allowedSorts(['id', 'start'])
        // ->where('user_id', auth()->user()->id)
        // ->paginate(10);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
