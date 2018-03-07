@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($threads) == 0)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class="h4 text-center">Belum ada ruang diskusi yang dibuat</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
        @foreach($threads as $thread)
            <div class="col-md-6">
                <div class="panel panel-default" style="margin-bottom:15px">
                    <div class="panel-heading">
                        {{ substr($thread->title, 0,70) }}
                        @if(strlen($thread->title) > 70)
                            ...
                        @endif
                        <p class="pull-right">{{ $thread->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            @if($thread->image !=="")
                                <img class="img-rounded" src="{{ asset('storage').'/'.$thread->image_small }}"
                                     style="max-height: 75px; width: 150px">
                            @else
                                <div style="width: 150px; height:70px; background: #2f6aac">
                                    <p style="color: #8eaed6; padding: 5px 10px;">NO IMAGE</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            {{ substr($thread->body, 0, 80)}}
                            @if(strlen($thread->body) > 80)
                                ...
                            @endif

                            <p><a href="{{ route('thread.show', ['thread'=>$thread->id]) }}">Read More</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{ $threads->links() }}
            </div>
        </div>
    </div>


@endsection