<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articles = Article::latest()->cursorPaginate(10);
        if ($request->wantsJson()) {
            return ArticleResource::collection($articles);
        }

        return Inertia::render('Home', ['articles' => ArticleResource::collection($articles)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('image')) {
            $article->image_path = $request->file('image')->store('images', 'public');
        }

        $article->save();

        // TODO handle errors
        return Redirect::route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->image_path = Storage::url($article->image_path);
        $article->load('category');
        $article->load('user');

        return Inertia::render('Article', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->validated());

        return Redirect::route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        // TODO check if the user is the owner of the article
        $article->delete();
        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        return Redirect::route('home');
    }

    /**
     * Display a listing of the resource.
     */
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
