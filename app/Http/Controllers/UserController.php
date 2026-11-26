<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Enums\TicketStatus;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function index(Request $request) {

        return UserResource::collection(User::orderBy("first_name")->get());
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return new UserResource($user);
    }

    // EDIT
    public function update(UserRequest $request, User $user)
    {
        $this->authorize("update", $user);

        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Delete a user, unless unresolved tickets are linked to them.
     *
     * A ticket is unresolved when its status is not "closed". Tickets the user
     * created or is assigned to both count.
     *
     * @param User $user The user to delete.
     * @throws ValidationException When unresolved tickets are linked to the user.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->authorize("delete", $user);

        $hasUnresolvedTickets =
            $user->createdTickets()->where("status", "!=", TicketStatus::CLOSED)->exists()
            || $user->assignedTickets()->where("status", "!=", TicketStatus::CLOSED)->exists();

        if ($hasUnresolvedTickets) {
            throw ValidationException::withMessages([
                "user" => "This user cannot be deleted because unresolved tickets are linked to them.",
            ]);
        }

        $user->delete();

        return response()->json([
            "message" => "User deleted successfully.",
        ]);
    }

    // GET ADMINS
    public function admins()
    {
        return UserResource::collection(
            User::where('is_admin', true)->get()
        );
    }
}
