<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Ticket;
use App\Models\Note;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;


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

    public function show(Note $note)
    {
        $this->authorize('view', $note);

        return new NoteResource($note->load('user'));
    }

    /**
     * Saves a note for this ticket and the signed in author.
     */
    public function store(StoreNoteRequest $request, Ticket $ticket) 
    {
        $note = $ticket->notes()->create([
            "content" => $request->validated("content"),
            "user_id" => $request->user()->id,
        ]);

        return (new NoteResource($note->load("user")))
        ->response()->setStatusCode(201);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $this->authorize("update", $note);

        $note->update($request->validated());

        return new NoteResource($note);
    }
    
    public function destroy(Note $note)
    {
        $this->authorize("delete", $note);

        if ($note->tickets()->exists()) {
            throw ValidationException::withMessages([
                "note" => "This note cannot be deleted because tickets are linked to it.",
            ]);
        }

        $note->delete();

        return response()->json([
            "message" => "Note deleted successfully.",
        ]);
    }
}

    
