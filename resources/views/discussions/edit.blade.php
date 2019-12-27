@extends('layouts.app')

@section('content')

    @include('includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">Edit discussion</div>

        <div class="panel-body">
            <form action="{{ route('discussion.update', ['id' => $discussion->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="form-group">
                    <lable for="content">Ask a question</lable>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">
                        {{$discussion->content}}
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="title">Image</label>
                    <input type="file" name="d_img" >
                </div>

                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">
                        Save discussion changes
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
