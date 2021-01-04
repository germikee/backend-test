<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_news_list()
    {
        $news = News::factory(2)->create();

        $this->json('GET', route('news.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'title',
                        'author',
                        'article',
                        'is_published'
                    ],
                ]
            ]);
    }

    /** @test */
    public function test_create_news()
    {
        $news = News::factory()->make();

        $response = $this->json('POST', route('news.store'), $news->toArray())
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'author',
                    'article',
                    'is_published'
                ]
            ]);
    }

    /** @test */
    public function test_get_news()
    {
        $news = News::factory()->create();

        $response = $this->json('GET', route('news.show', $news->id), $news->toArray())
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'author',
                    'article',
                    'is_published'
                ]
            ]);
    }

    /** @test */
    public function test_update_news()
    {
        $news = News::factory()->create();

        $response = $this->json('GET', route('news.update', $news->id), [
                'title' => 'The A Team'
            ])
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'title',
                    'author',
                    'article',
                    'is_published'
                ]
            ]);
    }

    /** @test */
    public function test_delete_news()
    {
        $news = News::factory()->create();

        $response = $this->json('DELETE', route('news.destroy', $news->id))->assertNoContent();
    }
}
