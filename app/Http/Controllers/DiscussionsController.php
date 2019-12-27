<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class DiscussionsController extends Controller
{
    public function create()
    {
        return view('discuss');
    }

    public function store()
    {
        $r = request();

        $this->validate($r, [
            'channel_id' => 'required',
            'content' => 'required',
            'title' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $r->title,
            'content' => $r->content,
            'channel_id' => $r->channel_id,
            'user_id' => Auth::user()->id,
            'slug' => str_slug($r->title)
        ]);

        if($r->hasFile('d_img'))
        {
            $img = $r->d_img;
            $img_new_name = time().$img->getClientOriginalName();
            $img->move('uploads/discussions/', $img_new_name);

            $discussion->img = 'uploads/discussions/'.$img_new_name;

            $discussion->save();
        }

        Session::flash('success', 'Discussion created successfully');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        $disc = Discussion::where('slug', $slug)->first();

        $best_answer = $disc->replies()->where('best_answer', 1)->first();

        return view('discussions.show')->with('d', $disc)
                                            ->with('b_answer', $best_answer);
    }

    public function reply($id)
    {
        $d = Discussion::find($id);


        $reply = Reply::create([
           'content' => request()->reply,
           'user_id' => Auth::user()->id,
           'discussion_id' => $id
        ]);

        if(request()->hasFile('r_img'))
        {
            $img = request()->r_img;
            $img_new_name = time().$img->getClientOriginalName();
            $img->move('uploads/replies/', $img_new_name);

            $reply->img = 'uploads/replies/'.$img_new_name;

            $reply->save();
        }

        $reply->user->points += 25;
        $reply->user->save();

        $watchers = array();

        foreach($d->watchers as $w)
        {
            array_push($watchers, User::find($w->user->id));
        }

//        try{
//            Notification::send($watchers, new NewReplyAdded($d));
//        }
//        catch(\Exception $ex)
//        {
//
//        }


        Session::flash('success', 'Replied to discussion');

        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit')->with('discussion', Discussion::where('slug', $slug)->first());
    }

    public function update($id)
    {
        $this->validate(\request(), [
           'content' => 'required'
        ]);

        $discussion = Discussion::find($id);

        $discussion->content = \request()->content;
        $discussion->save();

        if(request()->hasFile('d_img'))
        {
            $img = request()->d_img;
            $img_new_name = time().$img->getClientOriginalName();
            $img->move('uploads/discussions/', $img_new_name);

            $discussion->img = 'uploads/discussions/'.$img_new_name;

            $discussion->save();
        }

        Session::flash('success', 'Discussion updated successfully');


        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

}

