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
        $ticket = Ticket::create($request->validated()); 

        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }
}
