@extends('layouts.app')


@section('content')

    @include('includes.errors')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit your profile
        </div>
        <div class="panel-body">
            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data" >
                {{csrf_field()}}

                <div class="form-group">
                    <label for="name">User</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="pwd">New password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="avatar">Upload Avatar</label>
                    <input type="file" name="avatar" class="">
                </div>

                <div class="form-group">
                    <label for="fb">Facebook profile</label>
                    <input type="text" name="facebook" class="form-control" value="{{ $user->profile->facebook }}">
                </div>

                <div class="form-group">
                    <label for="yt">Youtube</label>
                    <input type="text" name="youtube" class="form-control" value="{{ $user->profile->youtube }}">
                </div>

                <div class="form-group">
                    <label for="about">About you</label>
                    <textarea name="about" id="about" cols="6" rows="6" class="form-control">
                         {{$user->profile->about}}
                    </textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

