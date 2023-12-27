<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Throwable;

class NewPasswordController extends Controller
{
    public function create(string $token)
    {
        return view('dashboard.pages.auth.reset-password', compact('token'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'auth'     => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
        ], $this->validationMessages());

        try {
            $email = Crypt::decrypt($request->auth);
            $user = Admin::where('email', $email)->firstOr(function () {
                throw ValidationException::withMessages([
                    'auth' => __('passwords.invalid_email'),
                ]);
            });
        } catch (Throwable $throwable) {
            return back()->with('error', __('passwords.invalid_email'));
        }

        if (Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', __('passwords.match_old_password'));
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        event(new PasswordReset($user));
        auth('admin')->login($user);

        return redirect(RouteServiceProvider::ADMIN_HOME)
            ->with('success', __('passwords.reset'));
    }

    protected function validationMessages(): array
    {
        return [
            'email.required'     => __('global.Email is required'),
            'email.email'        => __('global.Email field must be a valid email format'),
            'password.required'  => __('global.Password is required'),
            'password.confirmed' => __('global.Password must match password confirmation'),
            'password.min'       => __('global.Password minimum 8 characters'),
        ];
    }
}
