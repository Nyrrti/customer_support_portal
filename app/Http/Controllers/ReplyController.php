<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

class ReplyController extends Controller
{
    /**
     * Get all replies belonging to a ticket.
     */
    public function index(Ticket $ticket): JsonResponse
    {
        $replies = $ticket->replies()
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($replies);
    }
}
