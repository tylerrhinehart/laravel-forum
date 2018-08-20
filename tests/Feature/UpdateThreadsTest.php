<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->signIn()->withExceptionHandling();
    }

    /** @test */
    function a_thread_requires_a_title_and_body_to_be_updated()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed'
        ])->assertSessionHasErrors('body');

        $this->patch($thread->path(), [
            'body' => 'Changed body.'
        ])->assertSessionHasErrors('title');
    }

    /** @test */
    function unauthorized_users_may_not_update_threads()
    {
        $thread = create('App\Thread', ['user_id' => create('App\User')->id]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body'  => 'Changed body.'
        ])->assertStatus(403);
    }

    /** @test */
    function a_thread_can_be_updated_by_its_creator()
    {
        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $this->patch($thread->path(), [
            'title' => 'Changed',
            'body'  => 'Changed body.'
        ]);

        $this->assertEquals('Changed', $thread->fresh()->title);
        $this->assertEquals('Changed body.', $thread->fresh()->body);
    }
}