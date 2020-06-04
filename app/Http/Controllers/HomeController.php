<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('front.welcome');
    }

}
