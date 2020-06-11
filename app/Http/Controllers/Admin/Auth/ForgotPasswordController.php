<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class ForgotPasswordController
 * @package App\Http\Controllers\Admin\Auth
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * @return Application|Factory|View
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }
}
