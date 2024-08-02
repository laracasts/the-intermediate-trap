<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Notifications\BestReplyNotification;

class BestReplyController extends Controller
{
    public function __invoke(Reply $reply)
    {
        $reply->update(['best' => true]);

        $reply->user->activity()->create([
            'type' => 'best_reply',
        ]);

        $reply->user->increment('experience', 1000);

        $reply->user->notify(
            new BestReplyNotification($reply)
        );
    }
}
