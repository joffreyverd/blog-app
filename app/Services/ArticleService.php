<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function listWithRelations(Article $article)
    {
        return $article->load('category', 'user');
    }
}
