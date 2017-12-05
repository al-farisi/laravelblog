<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //$this->assertTrue(true);
        
        // $response = $this->get('/');
        // $response->assertStatus(200);

        $this->get('/')->assertSee('The Bootstrap Blog');
    }

    public function testPostArchives()
    {
        // given: there are two records in the database that are posts,
        // and each one is posted a month apart
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        // when: fetch the archives
        $posts = Post::archives();

        //dd($posts);
        // Then the response should be in the proper format
        //$this->assertCount(2, $posts);
        $this->assertEquals([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('F'),
                "published" => 1
            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('F'),
                "published" => 1
            ]
        ], $posts);

    }
}
