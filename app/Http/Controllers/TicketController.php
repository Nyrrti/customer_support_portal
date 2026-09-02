<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
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
}
