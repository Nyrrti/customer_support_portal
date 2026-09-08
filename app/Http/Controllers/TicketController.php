<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index() {
        $tickets = Ticket::with([
            "createdBy",
            "assignedTo",
            "category",
        ])->get();

        return TicketResource::collection($tickets);
    }

    // CREATE
    public function store(StoreTicketRequest $request) {
        $this->authorize('create', Ticket::class);

        $data = $request->validated();
        
        // Add logged-in user id
        $data["created_by_id"] = $request->user()->id;
        $data["status"] = "Open";

        // Create ticket with form data + creator id
        Ticket::create($data);

        $tickets = Ticket::with([
            "createdBy",
            "assignedTo",
            "category",
        ])->get();

        return TicketResource::collection($tickets);
    }

    // VIEW
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return $ticket->load([
            "createdBy",
            "assignedTo",
            "category",
        ]);
    }

    public function update(StoreTicketRequest $request, Ticket $ticket) {
        $ticket->update($request->validated());
        
        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }
}
