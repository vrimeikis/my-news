<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $article = $this->articleRepository->getActiveBySlug($slug);

        return view('front.article', [
            'article' => $article,
        ]);
    }
}
