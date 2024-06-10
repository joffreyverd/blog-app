<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use App\Services\ArticleService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ArticleController extends Controller
{
    private $articleService;

    private $imageService;

    public function __construct(ArticleService $articleService, ImageService $imageService)
    {
        $this->articleService = $articleService;
        $this->imageService = $imageService;
    }

    public function index(Request $request)
    {
        $articles = Article::latest()->cursorPaginate(10);
        if ($request->wantsJson()) {
            return ArticleResource::collection($articles);
        }

        return Inertia::render('Home', ['articles' => ArticleResource::collection($articles)]);
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        try {
            if ($request->hasFile('image')) {
                $article->image_path = $request->file('image')->store('images', 'public');
            }
            $article->save();
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to create article');
        }

        return Redirect::route('articles.show', $article);
    }

    public function show(Article $article)
    {
        $articleWithRelations = $this->articleService->listWithRelations($article);
        $articleWithRelations->image_path = $this->imageService->get($articleWithRelations->image_path);

        return Inertia::render('Article', ['article' => $articleWithRelations]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        try {
            if ($request->hasFile('image')) {
                $this->imageService->delete($article->image_path);
                $article->image_path = $request->file('image')->store('images', 'public');
            }
            $article->update($request->validated());
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to update article');
        }

        return Redirect::route('articles.show', $article);
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();
            $this->imageService->delete($article->image_path);
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Failed to delete article');
        }

        return Redirect::route('home');
    }

    public function create(Request $request)
    {
        $articleId = $request->query('article', null);
        $categories = Category::all();
        $props = ['categories' => $categories];
        if ($articleId) {
            $props['article'] = Article::find($articleId);
        }

        return Inertia::render('WriteArticle', $props);
    }
}
