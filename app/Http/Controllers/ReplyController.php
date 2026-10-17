<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
}
