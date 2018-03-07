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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-bottom:5px">
                    <div class="panel-heading">
                        {{ $thread->title }} | {{ $thread->created_at->diffForHumans() }}
                        <div class="pull-right">
                            @if(auth()->user()->can('update-thread'))
                                <a class="btn btn-success btn-xs"
                                   href="{{ route('thread.edit',['thread'=>$thread->id]) }}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                    Edit
                                </a>
                            @endif
                            @if(auth()->user()->can('delete-thread'))
                                <a class="btn btn-danger btn-xs"
                                   href="{{ route('thread.destroy', ['thread'=>$thread->id]) }}"
                                   onclick="confirm('Anda yakin untuk menghapus thread ini?');
                                   event.preventDefault(); document.getElementById('logout-form{{ $loop->iteration }}').submit();">
                                    <span class="glyphicon glyphicon-unchecked"></span>
                                    Delete
                                </a>
                                <form id="logout-form{{ $loop->iteration }}" action="{{ route('thread.destroy', ['thread'=>$thread->id]) }}"
                                      method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        {{--<div class="col-md-3">--}}
                            {{--@if($thread->image !=="")--}}
                                {{--<img class="img-thumbnail" src="{{ asset('storage').'/'.$thread->image_small }}" width="150">--}}
                            {{--@else--}}
                                {{--<div style="width: 150px; height:70px; background: #2f6aac">--}}
                                    {{--<p style="color: #8eaed6; padding: 5px 10px;">NO IMAGE</p>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        <div class="col-md-12">
                            <p><strong>TS: {{ $thread->owner->name  }}</strong></p>
                            <p>
                            {{ substr($thread->body, 0, 100)}}
                            @if(strlen($thread->body) > 100)
                                ...
                            @endif
                            </p>

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