<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use \Mockery;
use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class PostTest extends TestCase
{
    public function setUp()
    {
      parent::setUp();
     
      $this->mock = $this->mock('Cribbb\Storage\User\UserRepository');
    }

    public function mock($class)
    {
      $mock = Mockery::mock($class);
     
      $this->app->instance($class, $mock);
     
      return $mock;
    }

    public function tearDown()
    {
      Mockery::close();
    }

    public function testIndex()
    {
      $this->mock->shouldReceive('all')->once();
    }

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    // public function testExample()
    // {
    //     //$this->assertTrue(true);

    //     Bus::fake();
        
    //     // Perform order shipping...

    //     Bus::assertDispatched(Post::class, function ($job) use ($order) {
    //         return $job->order->id === $order->id;
    //     });

    //     // Assert a job was not dispatched...
    //     Bus::assertNotDispatched(AnotherJob::class);
    // }
}
