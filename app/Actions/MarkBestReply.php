<?php

namespace App\Actions;

use App\Models\Reply;
use App\Notifications\BestReplyNotification;

class MarkBestReply
{
    public function handle(Reply $reply): void
    {
        $reply->update(['best' => true]);

        $this->recordActivity($reply);
        $this->awardExperience($reply);
        $this->notifyUser($reply);
    }

    public function recordActivity(Reply $reply): void
    {
        $reply->user->activity()->create([
            'type' => 'best_reply',
        ]);
    }

    public function awardExperience(Reply $reply): void
    {
        $reply->user->increment('experience', 1000);
    }

    public function notifyUser(Reply $reply): void
    {
        $reply->user->notify(
            new BestReplyNotification($reply)
        );
    }
}
