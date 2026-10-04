<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request) {

        $user = $request->user();

        $query = Ticket::with([
            "createdBy",
            "assignedTo",
            "category",
        ]);

        if (!$user->is_admin) {
            $query->where("created_by_id", $user->id);
        }
        return TicketResource::collection($query->get());
    }

    // CREATE
    public function store(StoreTicketRequest $request)
    {
        $this->authorize("create", Ticket::class);

        $data = $request->validated();

        $data["created_by_id"] = $request->user()->id;
        $data["status"] = "pending";

        $ticket = Ticket::create($data);

        return new TicketResource(
            $ticket->load([
                "createdBy",
                "assignedTo",
                "category",
            ])
        );
    }

    // VIEW
    public function show(Ticket $ticket)
    {
        $this->authorize("view", $ticket);
            return new TicketResource($ticket->load([
            "createdBy",
            "assignedTo",
            "category",
        ]));
    }

    // EDIT
    public function update(StoreTicketRequest $request, Ticket $ticket)
    {
        $this->authorize("update", $ticket);

        $ticket->update($request->validated());

        return new TicketResource(
            $ticket->load([
                "createdBy",
                "assignedTo",
                "category",
            ])
        ); 
    }

    // DELETE
    public function destroy(Ticket $ticket)
    {
        $this->authorize("delete", $ticket);

        $ticket->delete();

        return response()->noContent();
    }
}
