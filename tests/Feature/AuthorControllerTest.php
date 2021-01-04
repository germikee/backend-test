<?php

namespace Tests\Feature;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_get_author_list()
    {
        $author = Author::factory(2)->create();

        $this->json('GET', route('author.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'first_name',
                        'last_name'
                    ],
                ]
            ]);
    }

    /** @test */
    public function test_create_author()
    {
        $author = Author::factory()->make();

        $response = $this->json('POST', route('author.store'), $author->toArray())
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'first_name',
                    'last_name'
                ]
            ]);
    }

    /** @test */
    public function test_get_author()
    {
        $author = Author::factory()->create();

        $response = $this->json('GET', route('author.show', $author->id), $author->toArray())
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'first_name',
                    'last_name'
                ]
            ]);
    }

    /** @test */
    public function test_update_author()
    {
        $author = Author::factory()->create();

        $response = $this->json('GET', route('author.update', $author->id), [
                'first_name' => 'John',
                'last_name' => 'Doe'
            ])
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'first_name',
                    'last_name'
                ]
            ]);
    }

    /** @test */
    public function test_delete_author()
    {
        $author = Author::factory()->create();

        $response = $this->json('DELETE', route('author.destroy', $author->id))->assertNoContent();
    }
}
