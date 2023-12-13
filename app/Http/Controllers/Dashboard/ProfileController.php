<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\ChangePasswordRequest;
use App\Http\Requests\Dashboard\Profile\CodeVerificationRequest;
use App\Http\Requests\Dashboard\Profile\UpdateRequest;
use App\Mail\Dashboard\Profile\SendVerificationCode;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), 403);

        return view('dashboard.pages.profile.edit', [
            'user' => authUser(),
        ]);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        authUser()?->update([
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return redirect()
            ->route('dashboard.profile.edit')
            ->with('success', __('global.profile_updated'));
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        authUser()?->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect()
            ->route('dashboard.profile.edit')
            ->with('success', __('global.password_updated'));
    }

    public function toggleDarkMode()
    {
        if (request()?->expectsJson()) {
            authUser()?->update([
                'dark_mode_enabled' => !authUser()?->dark_mode_enabled
            ]);

            return response()->noContent();
        }

        abort(404);
    }

    /**
     * @throws Exception
     */
    public function getVerification()
    {
        $user  = authUser();
        $email = $user?->email;

        $code = randomCode();

        $user?->update([
            'verification_code' => $code,
        ]);

        Mail::to($email)->send(new SendVerificationCode($code));

        session()->flash('success_message', 'تم إرسال كود التحقق الى بريدك الإلكتروني');

        return view('dashboard.pages.profile.verification-code');
    }

    public function postVerification(CodeVerificationRequest $request): RedirectResponse
    {
        $user = authUser();
        if ($user?->verification_code !== $request->get('code')) {
            return back()->withErrors(['code' => 'كود التحقق غير صحيح']);
        }

        $user?->update([
            'email_verified_at' => now(),
            'verification_code' => null,
            'verified'          => true,
        ]);

        return redirect()->route('dashboard.home')
            ->with('success_message', 'تم التحقق بنجاح');
    }
}
