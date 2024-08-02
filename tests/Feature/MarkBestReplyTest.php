<?php

use App\Models\Reply;
use App\Notifications\BestReplyNotification;
use Illuminate\Support\Facades\Notification;

it('marks the best reply on the thread', function () {
    $reply = Reply::factory()->create();

    expect($reply->best)->toBeFalse();

    $this->post("/replies/{$reply->id}/best")->assertOk();

    expect($reply->fresh()->best)->toBeTrue();
});

it('records activity', function () {
    $reply = Reply::factory()->create();

    $this->post("/replies/{$reply->id}/best")->assertOk();

    expect($reply->user->activity)->toHaveCount(1);
});

it('awards experience', function () {
    $reply = Reply::factory()->create();

    expect($reply->user->experience)->toBe(0);

    $this->post("/replies/{$reply->id}/best")->assertOk();

    expect($reply->user->fresh()->experience)->toBe(1000);
});

it('notifies the owner of the reply', function () {
    Notification::fake();

    $reply = Reply::factory()->create();

    $this->post("/replies/{$reply->id}/best")->assertOk();

    Notification::assertSentTo(
        $reply->user, BestReplyNotification::class
    );

});
