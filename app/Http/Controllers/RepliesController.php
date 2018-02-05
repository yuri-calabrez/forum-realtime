<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Http\Requests\ReplyRequest;
use App\Events\NewReply;

class RepliesController extends Controller
{
    public function show($id)
    {
        $replies = Reply::where('thread_id', $id)
            ->with('user')
            ->get();
        return $replies;
    }

    public function store(ReplyRequest $request)
    {
        $reply = new Reply();
        $reply->body = $request->input('body');
        $reply->thread_id = $request->input('thread_id');
        $reply->user_id = \Auth::user()->id;
        $this->authorize('isClosed', $reply);
        $reply->save();

        broadcast(new NewReply($reply));

        return response()->json($reply);
    }

    public function highlight($id)
    {
        $reply = Reply::find($id);

        $this->authorize('update', $reply);

        Reply::where([
            ['id', '!=', $id],
            ['thread_id', '=', $reply->thread_id]
        ])->update(['highlited' => false]);
       
        $reply->highlited = true;
        $reply->save();

        return redirect('threads/'.$reply->thread_id);
    }
}
