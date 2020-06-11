<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class LoginController
 * @package App\Http\Controllers\Admin\Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * @return Guard|StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
