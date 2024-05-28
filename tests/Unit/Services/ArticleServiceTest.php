<?php

namespace Tests\Unit\Services;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use App\Services\ArticleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testListWithRelations()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $service = new ArticleService;
        $articleWithRelations = $service->listWithRelations($article);

        $this->assertTrue($articleWithRelations->relationLoaded('category'));
        $this->assertTrue($articleWithRelations->relationLoaded('user'));
        $this->assertEquals($category->id, $articleWithRelations->category->id);
        $this->assertEquals($user->id, $articleWithRelations->user->id);
    }
}
