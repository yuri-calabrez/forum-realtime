<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testActionIndexController()
    {
        $user = factory(\App\User::class)->create();
        $threads = Thread::orderBy('updated_at', 'desc')->paginate();
        $this->seed('ThreadsTableSeeder');
        $this
            ->actingAs($user)
            ->json('GET', '/threads')
            ->assertStatus(200)
            ->assertJsonFragment([$threads->toArray()['data']]);
    }*/

    public function testActionStore()
    {
        $user = factory(\App\User::class)->create();
        $response = $this
                        ->actingAs($user)
                        ->json('POST', '/threads', ['title' => 'Post title', 'body' => 'Post body']);

            $thread = Thread::find(1);

            $response
                ->assertStatus(200)
                ->assertJsonFragment(['created' => 'success'])
                ->assertJsonFragment([$thread->toArray()]);
    }

    public function testActionUpdate()
    {
        $user = factory(\App\User::class)->create();
        $thread = factory(\App\Thread::class)->create();
        $response = $this
                        ->actingAs($user)
                        ->json('PUT', '/threads/'.$thread->id, ['title' => 'Post title up', 'body' => 'Post body up']);

            $thread->title = 'Post title up';
            $thread->body = 'Post body up';

            $response->assertStatus(302);
            $this->assertEquals(\App\Thread::find(1)->toArray(), $thread->toArray());
    }
}
