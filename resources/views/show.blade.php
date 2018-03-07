@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="margin-bottom: 5px;">
                    <div class="panel-heading h3 text-center" style="margin: 0;">{{ $thread->title }} </div>
                    <div class="panel-heading text-center">{{ $thread->owner->name }} | {{ $thread->created_at->diffForHumans() }}</div>
                    <div class="panel-body">
                        @if($thread->image !== "")
                        <div class="col-md-12" style="padding-bottom: 1em;">
                            <img class="img-thumbnail" src="{{ asset('storage').'/'.$thread->image }}" style="width: 100%">
                        </div>
                        @endif
                        <div class="col-md-12">
                            {{$thread->body}}
                        </div>
                    </div>
                </div>

                @if(!auth()->check())
                    <div class="text-center h4 text-success">
                        <a href="{{ route('login') }}">Login</a> untuk bergabung di dalam forum
                    </div>
                @endif

                @foreach($replies as $reply)
                    <div class="panel panel-default" style="margin-bottom: 5px;">
                        <div class="panel-heading text-center">
                            {{$reply->owner->name}} - {{ $reply->created_at->diffForHumans() }}
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                {{$reply->body}}
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(auth()->check())
                    @permission('create-reply')
                    <div class="panel panel-default">
                        <div class="panel-heading">Reply</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ url()->current().'/replies' }}">
                            {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <textarea id="body" type="text" class="form-control" name="body" rows="4"
                                                  value="{{ old('body') }}" required></textarea>

                                        @if ($errors->has('body'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endpermission
                @endif

                {{ $replies->links() }}
            </div>
        </div>
    </div>
@endsection