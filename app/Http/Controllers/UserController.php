<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;


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

    // DELETE
    public function destroy(User $user)
    {
        $this->authorize("delete", $user);

        if ($user->createdTickets()->exists() || $user->assignedTickets()->exists()) {
            throw ValidationException::withMessages([
                "user" => "This user cannot be deleted because tickets are linked to it.",
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
