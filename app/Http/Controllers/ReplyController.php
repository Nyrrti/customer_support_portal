<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Ticket;
use App\Models\Reply;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Notifications\TicketReplied;

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
     * Saves a reply for this ticket and emails the ticket's creator.
     *
     * A failed email is logged, so the reply is still saved.
     */
    public function store(StoreReplyRequest $request, Ticket $ticket)
    {
        $reply = $ticket->replies()->create([
            "title" => $request->validated("title"),
            "content" => $request->validated("content"),
            "user_id" => $request->user()->id,
        ]);

        // Don't email admins about their own reply on their own ticket.
        if ($ticket->created_by_id !== $request->user()->id) {
            try {
                $ticket->createdBy->notify(new TicketReplied($reply));
            } catch (\Throwable $e) {
                // The reply is saved, even if email fails
                report($e);
            }
        }

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
