<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Admin\Auth
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * @param Request $request
     * @param null $token
     * @return Application|Factory|View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.passwords.reset', [
            'token' => $token,
            'email' => $request->input('email'),
        ]);
    }

    /**
     * @return mixed
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
