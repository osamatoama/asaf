<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Profile\ChangePasswordRequest;
use App\Http\Requests\Dashboard\Profile\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

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
}
