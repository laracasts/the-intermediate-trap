<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function index()
    {
        return Thread::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'body'  => ['required'],
        ]);

        return Thread::create($data);
    }

    public function show(Thread $thread)
    {
        return $thread;
    }

    public function update(Request $request, Thread $thread)
    {
        $data = $request->validate([
            'title' => ['required'],
            'body'  => ['required'],
        ]);

        $thread->update($data);

        return $thread;
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();

        return response()->json();
    }
}
