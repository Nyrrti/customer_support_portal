<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{

    /**
     * Confirm the user's email address from the link in the verification email.
     *
     * The signed middleware checks that the link is valid and not expired.
     * The hash check makes sure the link belongs to this user's email address.
     *
     * @param string $id   The ID of the user to verify.
     * @param string $hash The SHA-1 hash of the user's email address.
     */
    public function __invoke(string $id, string $hash)
    {
        $user = User::find($id);

        // Same check Laravel's EmailVerificationRequest does
        if (! $user || ! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
            return redirect("/?verification=invalid");
        }

        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        // Back to the Vue login page
        return redirect("/?verified=1");
    }
}
