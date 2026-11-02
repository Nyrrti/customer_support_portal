<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Note;

class NotePolicy
{
    public function view(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Note $note): bool
    {
        return $user->isAdmin();
    }
}
