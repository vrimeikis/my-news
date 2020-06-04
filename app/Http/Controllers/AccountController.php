<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\AccountUpdateRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();

        return view('front.account.index', ['user' => $user]);
    }

    public function edit(): View
    {
        $user = auth()->user();

        return view('front.account.form', ['user' => $user]);
    }

    public function update(AccountUpdateRequest $request): RedirectResponse
    {
        try {
            /** @var User $user */
            $user = auth()->user();

            $user->update($request->getData());

        } catch (\Exception $exception) {
            return back()->with('danger', $exception->getMessage())
                ->withInput();
        }

        return redirect()->route('account.index')
            ->with('success', 'Your account data updated.');
    }
}
