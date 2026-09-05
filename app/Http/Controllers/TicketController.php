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

    public function store(StoreTicketRequest $request) {
        $data = $request->validated();
        
        
        // Add logged-in user id
        // $data["created_by_id"] = $request->user()->id;
        // TEMP
        $data["created_by_id"] = 1;

        // Create ticket with form data + creator id
        Ticket::create($data);

        $tickets = Ticket::with([
            "createdBy",
            "assignedTo",
            "category",
        ])->get();

        return TicketResource::collection($tickets);
    }
}
