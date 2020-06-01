<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class AdminHomeController
 * @package App\Http\Controllers\Admin
 */
class AdminHomeController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin.home');
    }
}
