<?php

namespace App\Observers;

use App\Thread;
use App\Reply;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $thread = Thread::find( $reply->thread_id);
        $thread->replies_count += 1;
        $thread->save();
    }
}