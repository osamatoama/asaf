<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Dashboard\Auth\SendPasswordResetCode;
use App\Models\Admin;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Throwable;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('dashboard.pages.auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = Admin::where('email', $request->email)->firstOr(function () {
            throw ValidationException::withMessages([
                'email' => __('passwords.invalid_email'),
            ]);
        });

        $code = randomCode();

        PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'code'       => $code,
            'created_at' => now(),
        ]);

        Mail::to($user->email)->send(new SendPasswordResetCode($code));

        return redirect()
            ->route('password.code', Crypt::encrypt($user->email))
            ->with('success', __('passwords.sent'));
    }

    public function code(string $token)
    {
        try {
            $email = Crypt::decrypt($token);
        } catch (Throwable $throwable) {
            return redirect()
                ->route('password.request')
                ->with('error', __('passwords.invalid_email'));
        }

        return view('dashboard.pages.auth.password-code', compact('email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'auth' => 'required|email',
            'code' => 'required|digits:4',
        ]);

        $exists = PasswordReset::where([
            'email' => $request->auth,
            'code'  => $request->code,
        ])->exists();
        if (!$exists) {
            return back()->with('error', __('global.invalid_verify_code'));
        }

        return redirect()->route('password.reset', Crypt::encrypt($request->auth));
    }
}
