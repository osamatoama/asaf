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
        abort_if(Gate::denies('profile_password_edit'), 403, 'ليس لديك صلاحية');

        return view('dashboard.pages.profile.edit', [
            'user' => authUser('admin'),
        ]);
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        authUser('admin')?->update([
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return redirect()
            ->route('dashboard.profile.edit')
            ->with('success', __('global.profile_updated'));
    }

    public function changePassword(ChangePasswordRequest $request): RedirectResponse
    {
        authUser('admin')?->update([
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect()
            ->route('dashboard.profile.edit')
            ->with('success', __('global.password_updated'));
    }

    public function toggleDarkMode()
    {
        if (request()?->expectsJson()) {
            authUser('admin')?->update([
                'dark_mode_enabled' => !authUser('admin')?->dark_mode_enabled
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
        if (session()->missing('errors')) {
            $user = authUser('admin');

            abort_if($user?->isVerified(), 403, 'الحساب مفعل بالفعل');

            $email = $user?->email;
            $code = $user->verification_code ?? randomCode();

            $user?->update([
                'verification_code' => $code,
            ]);

            Mail::to($email)->send(new SendVerificationCode($code));

            session()->flash('success_message', 'تم إرسال كود التحقق الى بريدك الإلكتروني');
        }

        return view('dashboard.pages.profile.verification-code');
    }

    public function postVerification(CodeVerificationRequest $request): RedirectResponse
    {
        $user = authUser('admin');

        abort_if($user?->isVerified(), 403, 'الحساب مفعل بالفعل');

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
