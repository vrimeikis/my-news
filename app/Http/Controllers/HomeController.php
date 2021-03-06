<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * HomeController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return View
     */
    public function __invoke(): View
    {
        $articles = $this->articleRepository->getActivePaginate();

        return view('front.welcome', ['articles' => $articles]);
    }

}
