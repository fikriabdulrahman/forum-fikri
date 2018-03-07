<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $threads = Thread::orderByDesc('id')->paginate(6);
        return view('welcome', ['threads'=>$threads]);
    }

    public function show(Thread $thread)
    {
        $replies = Reply::where('thread_id', $thread->id)->paginate(5);
        return view('show', ['thread'=>$thread, 'replies'=>$replies]);
    }
}
