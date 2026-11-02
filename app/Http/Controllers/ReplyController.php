<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Ticket;
use App\Models\Reply;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;

class ReplyController extends Controller
{
    /**
     * Return replies for a ticket the current user may view.
     */
    public function index(Ticket $ticket): AnonymousResourceCollection
    {
        $this->authorize("view", $ticket);

        $replies = $ticket->replies()
            ->with("user")
            ->orderBy("created_at", "asc")
            ->get();

        return ReplyResource::collection($replies);
    }

    public function show(Reply $reply)
    {
        $this->authorize('view', $reply);

        return new ReplyResource($reply->load('user'));
    }

    /**
     * Saves a note for this ticket and the signed in author.
     */
    public function store(StoreReplyRequest $request, Ticket $ticket) 
    {
        $reply = $ticket->replies()->create([
            "title" => $request->validated("title"),
            "content" => $request->validated("content"),
            "user_id" => $request->user()->id,
        ]);

        return (new ReplyResource($reply->load("user")))
        ->response()->setStatusCode(201);
    }

    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        $reply->update($request->validated());

        return new ReplyResource($reply->load("user"));
    }
    
    public function destroy(Reply $reply)
    {
        $this->authorize("delete", $reply);

        $reply->delete();

        return response()->json([
            "message" => "Reply deleted successfully.",
        ]);
    }
}
