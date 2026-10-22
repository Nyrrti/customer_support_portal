<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Http\Requests\StoreNoteRequest;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class NoteController extends Controller
{
    /**
     * Return notes for a ticket the current admin user may view.
     */
    public function index(Ticket $ticket): AnonymousResourceCollection
    {
        $this->authorize("view", $ticket);

        $notes = $ticket->notes()
            ->with("user")
            ->orderBy("created_at", "asc")
            ->get();

        return NoteResource::collection($notes);
    }

    /**
     * Saves a note for this ticket and the signed in author.
     */
    public function store (StoreNoteRequest $request, Ticket $ticket) 
    {
        $note = $ticket->notes()->create([
            "content" => $request->validated("content"),
            "user_id" => $request->user()->id,
        ]);

        return (new NoteResource($note->load("user")))
        ->response()->setStatusCode(201);
    }
}

    
