<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function index()
    {
        return Reply::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'thread_id' => ['required', 'integer'],
            'user_id'   => ['required', 'integer'],
            'body'      => ['required'],
        ]);

        return Reply::create($data);
    }

    public function show(Reply $reply)
    {
        return $reply;
    }

    public function update(Request $request, Reply $reply)
    {
        $data = $request->validate([
            'thread_id' => ['required', 'integer'],
            'user_id'   => ['required', 'integer'],
            'body'      => ['required'],
        ]);

        $reply->update($data);

        return $reply;
    }

    public function destroy(Reply $reply)
    {
        $reply->delete();

        return response()->json();
    }
}
