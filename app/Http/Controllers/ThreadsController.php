<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ThreadsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        dd(Reply::find(20)->owner()->first());
        if(auth()->user()->hasRole(['superadmin','admin'])){
            $threads = Thread::orderByDesc('id')->paginate(5);
            return view('thread.index',['threads'=>$threads]);
        } else {
            return redirect()->route('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:4|max:190',
            'image'=> 'image|mimes:jpeg,bmp,png|max:2000',
            'body' => 'required|min:5'
        ]);

        $thread = new Thread();
        $thread->user_id = $request->user()->id;
        $thread->title = $request->title;
        $thread->slug = str_slug($request->title);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $newname = time().'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/images/', $request->file('image'), $newname);
            Storage::putFileAs('public/images/thumbnail/', $request->file('image'), $newname);
            $location = public_path('storage/images/thumbnail/'.$newname);
            $img = Image::make($image)->resize(400, 150, function($const) {
                $const->aspectRatio();
            });
            $img->save($location);
            $thread->image = 'images/'.$newname;
            $thread->image_small = 'images/thumbnail/'.$newname;
        }
        $thread->body = $request->body;
        $thread->save();

        return redirect()->route('thread.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
//        dd(auth()->user());
        return view('show', ['thread'=>$thread]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('thread.update', ['thread'=>$thread]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        $this->validate($request,[
            'title' => 'required|min:4|max:190',
            'image'=> 'image|mimes:jpeg,bmp,png|max:2000',
            'body' => 'required|min:5'
        ]);

        $thread->title = $request->title;
        $thread->slug = str_slug($request->title);
        $thread->body = $request->body;
        if($request->hasFile('image')){
            if($thread->image) {
                Storage::delete($thread->image);
                Storage::delete($thread->image_small);
            }
            $image = $request->file('image');
            $newname = time().'.'.$image->getClientOriginalExtension();
            Storage::putFileAs('public/images/', $request->file('image'), $newname);
            Storage::putFileAs('public/images/thumbnail/', $request->file('image'), $newname);
            $location = public_path('storage/images/thumbnail/'.$newname);
            $img = Image::make($image)->resize(400, 150, function($const) {
                $const->aspectRatio();
            });
            $img->save($location);
            $thread->image = 'images/'.$newname;
            $thread->image_small = 'images/thumbnail/'.$newname;
        }
        $thread->save();
        return redirect()->route('thread.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        if($thread->image) {
            Storage::delete($thread->image);
            Storage::delete($thread->image_small);
        }
        $thread->delete();
        return redirect()->back();
    }


    public function showMyThread(Request $request)
    {
//        dd(auth()->user()->id);
        $threads = Thread::where('user_id', auth()->user()->id)->paginate(5);;
        return view('thread.index',['threads'=>$threads]);
    }

}
