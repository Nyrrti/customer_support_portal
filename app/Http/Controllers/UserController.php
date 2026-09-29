<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request) {

        return UserResource::collection(User::orderBy("first_name")->get());
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

        $user->delete();

        return response()->noContent();
    }
}
