@extends('layouts.app')

@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{asset($d->user->profile->avatar)}}" width="40" height="40" alt="avatar" style="border-radius: 50%;">
                &nbsp;&nbsp;
                <span>{{$d->user->name}}
                    <span class="badge">{{$d->user->points}}</span>
                </span>

                @if($d->has_best_answer())
                    <span class="btn btn-danger pull-right btn-sm">Closed</span>
                @else
                    <span class="btn btn-success pull-right btn-sm">Open</span>
                @endif
                @if($d->user->id == \Illuminate\Support\Facades\Auth::id())
                    <a href="{{ route('discussion.edit', ['slug' => $d->slug]) }}" class="btn btn-info pull-right btn-sm">
                        Edit
                    </a>
                @endif
                @if($d->being_watched())
                    <a href="{{ route('discussion.unwatch', ['id' => $d->id]) }}" class="btn btn-default pull-right btn-sm">
                        Unwatch
                    </a>
                @else
                    <a href="{{ route('discussion.watch', ['id' => $d->id]) }}" class="btn btn-default pull-right btn-sm">
                        Watch
                    </a>
                @endif
            </div>
            <div class="panel-body">
                <h4 class="text-center"><b>{{ $d->title }}</b></h4>
                <hr>
                <pre >{{$d->content}}
                </pre>
                @if(!empty($d->img))
                    <p class="text-center">
                        <a href="{{asset($d->img)}}"  >
                            <img src="{{asset($d->img)}}" alt="" class="img-thumbnail" >
                        </a>
                    </p>
                @endif
                    <hr><br><br>
                @if($b_answer)
                    <div class="text-center">
                        <div class="panel panel-success">
                            <h3 style="font-family: 'Times New Roman'; text-decoration: underline; color: green;"><b>BEST ANSWER</b></h3>
                            <div class="panel-heading">
                                <img src="{{asset($b_answer->user->profile->avatar)}}"
                                     width="40" height="40" style="border-radius: 50%">
                                <span>{{$b_answer->user->name}} &nbsp;<span class="badge">{{$b_answer->user->points}}</span>
                                    </span>
                            </div>
                            <div class="panel-body">
                                <pre >{{ trim($b_answer->content)}}
                                </pre>
                                @if(!empty($b_answer->img))
                                    <p class="text-center">
                                        <a href="{{asset($b_answer->img)}}" >
                                            <img src="{{asset($b_answer->img)}}" alt=""  class="img-thumbnail" >
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="panel-footer">
                <p>
                    <b>{{ $d->created_at->diffForHumans() }}</b>
                    <a href="{{route('channel', ['slug' => $d->channel->slug])}}" class="btn btn-info pull-right btn-xs">
                        {{$d->channel->title}}
                    </a>
                </p>
            </div>
        </div>
    <h4>
       <b> Replies: ( {{$d->replies->count()}} )</b>
    </h4>
    @foreach($d->replies as $r)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{asset($r->user->profile->avatar)}}" width="40" height="40" alt="avatar" style="border-radius: 50%;">
                &nbsp;&nbsp;
                <span>{{$r->user->name}}&nbsp;<span class="badge">{{$r->user->points}}</span></span>

                @if(!$b_answer && $d->user->id == \Illuminate\Support\Facades\Auth::id())
                    <a href="{{ route('reply.best.answer', ['reply_id' => $r->id]) }}" class="btn btn-xs btn-primary pull-right">Mark as best answer</a>
                @endif

                @if($r->user->id == \Illuminate\Support\Facades\Auth::id() && !$r->best_answer)
                    <a href="{{ route('reply.edit', ['id' => $r->id]) }}" class="btn btn-xs btn-info pull-right">Edit</a>

                @endif

            </div>
            <div class="panel-body">
                <pre >{{$r->content}}
                </pre>
                @if(!empty($r->img))
                    <p class="text-center">
                        <a href="{{asset($r->img)}}" >
                            <img src="{{asset($r->img)}}" alt="" class="img-thumbnail">
                        </a>
                    </p>
                @endif
            </div>
            <div class="panel-footer">
                @if($r->is_liked_by_auth_user())
                    likes:
                    <span class="badge">{{ $r->likes->count() }}</span>&nbsp;&nbsp;
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{ route('reply.unlike', ['id' => $r->id]) }}" class="btn btn-danger btn-xs">
                            Unlike
                        </a>
                    @endif
                @else
                    likes:
                    <span class="badge">{{ $r->likes->count() }}</span>&nbsp;&nbsp;
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a href="{{ route('reply.like', ['id' => $r->id]) }}" class="btn btn-success btn-xs">
                            Like
                        </a>
                    @endif
                @endif
                    <b class="pull-right">{{$r->created_at->diffForHumans()}}</b>
            </div>
        </div>
    @endforeach

    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>
                <lable>Leave a reply</lable>
            </h5>
        </div>
        <div class="panel-body">
           @if(\Illuminate\Support\Facades\Auth::check())
                <form action="{{ route('discussion.reply', ['id' => $d->id]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">

                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Image</label>
                        <input type="file" name="r_img" >
                    </div>

                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success pull-right">
                                Leave a reply
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <div class="text-center">
                    <h3><a href="/login" class="" style="text-decoration: none;">
                            Log in to leave a reply
                        </a></h3>
                </div>
            @endif
        </div>
    </div>
@endsection


