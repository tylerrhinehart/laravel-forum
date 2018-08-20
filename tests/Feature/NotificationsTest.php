<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user()
    {
        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'text here',
        ]);

        $this->assertCount(0, auth()->user()->fresh()->notifications);
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'text here',
        ]);

//        dd(auth()->user()->fresh()->notifications);
        $this->assertCount(1, auth()->user()->fresh()->notifications);
    }

    /** @test */
    function a_user_can_get_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(1, $this->getJson("/profiles/" . auth()->user()->name . "/notifications")->json());
    }

    /** @test */
    function a_user_can_mark_a_notification_as_read()
    {
        create(DatabaseNotification::class);

        $user = auth()->user();

        $notificationId = $user->unreadNotifications->first()->id;

        $this->assertCount(1, $user->unreadNOtifications);

        $this->delete("/profiles/{$user->name}/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNOtifications);
    }
}