@extends('layouts.app')

@section('content')
    @if($discussions->count() > 0)
           @foreach($discussions as $d)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{$d->user->profile->avatar}}" width="40" height="40" alt="avatar" style="border-radius: 50%;">
                        &nbsp;&nbsp;
                        <span>{{$d->user->name}}</span>,
                        <b>{{$d->created_at->diffForHumans()}}</b>
                        @if($d->has_best_answer())
                            <span class="btn btn-danger pull-right btn-sm">Closed</span>
                        @else
                            <span class="btn btn-success pull-right btn-sm">Open</span>
                        @endif


                        <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn  btn-sm btn-default pull-right">
                            View
                        </a>
                    </div>
                    <div class="panel-body">
                        <h4 class="text-center" ><b>{{ $d->title }}</b></h4>
                        <pre >{{ trim(str_limit($d->content, 80))}}
                        </pre>

                        @if(!empty($d->img))

                            <div class="text-center img-responsive">
                                <a href="{{asset($d->img)}}"  >
                                    <img src="{{asset($d->img)}}" class="img-thumbnail" >
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="panel-footer">
                        <p>
                            {{$d->replies->count()}} Replies
                            <a href="{{route('channel', ['slug' => $d->channel->slug])}}" class="btn btn-info pull-right btn-xs">
                                {{$d->channel->title}}
                            </a>
                        </p>

                    </div>
                </div>

            @endforeach

            <div class="text-center">
                {{ $discussions->links() }}
            </div>
    @else
        <h1 class="text-center"> <b>No Data</b></h1>
    @endif
@endsection
