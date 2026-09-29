<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request) {

        return UserResource::collection(User::orderBy('first_name')->get());
    }

    // CREATE
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->validated();

        $data["created_by_id"] = $request->user()->id;
        $data["status"] = "Pending";

        User::create($data);

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
}
