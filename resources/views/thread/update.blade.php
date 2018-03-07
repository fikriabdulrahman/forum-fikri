@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Thread</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('thread.update',['thread'=>$thread->id]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="title" >Title</label>
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $thread->title }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <label for="body">Image</label>
                                    @if($thread->image !== "")
                                    <div class="col-md-12">
                                        <p>Gambar Sebelumnya</p>
                                        <p><div class="img-thumbnail">
                                            <img src="{{ asset('storage').'/'.$thread->image_small }}" alt="">
                                        </div></p>
                                    </div>
                                    @endif
                                    <input id="image" type="file" class="custom-file-input" name="image" value="{{ old('image') }}">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">

                                <div class="col-md-12">
                                    <label for="body">Body</label>
                                    <textarea id="body" type="text" class="form-control" name="body" rows="8"
                                              placeholder="Informasikan sesuatu ke dalama Thread"
                                              required>{{ $thread->body }}</textarea>

                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
