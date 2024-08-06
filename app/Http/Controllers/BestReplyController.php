<?php

namespace App\Http\Controllers;

use App\Actions\MarkBestReply;
use App\Models\Reply;

class BestReplyController extends Controller
{
    public function __invoke(Reply $reply, MarkBestReply $action)
    {
        $action->handle($reply);
    }
}
