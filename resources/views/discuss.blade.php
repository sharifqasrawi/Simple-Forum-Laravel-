@extends('layouts.app')

@section('content')

    @include('includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">Create a new discussion</div>

        <div class="panel-body">
            <form action="{{ route('discussion.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>



                <label for="channel">Pick a channel</label>
                <div class="form-group">
                    <select name="channel_id" id="channel_id" class="form-control">
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{ $channel->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <lable for="content">Ask a question</lable>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="title">Image</label>
                    <input type="file" name="d_img" >
                </div>

                <div class="form-group">
                    <button class="btn btn-success pull-right" type="submit">
                        Create discussion
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
