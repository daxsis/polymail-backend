<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    use VerifiesEmails;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show(Request $request)
    {

    }

    public function verify(Request $request): JsonResponse
    {
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()
        ) {
            event(new Verified($request->user()));
            return response()->json('Email Verified');
        } else {
            return response()->json('Email failed to verify!', 400);
        }
    }

    public function resend(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('User already has a verified email!', 422);
        }

        $request->user()->sendApiEmailVerificationNotification();
        return response()->json('Please check your email to verify');
    }
}
