<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RepliesController extends Controller
{
    public function like($id)
    {
        Like::create([
           'reply_id' => $id,
            'user_id' => Auth::id()
        ]);

        $reply = Reply::find($id);

        Session::flash('success', 'You liked '.$reply->user->name.' reply');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();

        $like->delete();

        $reply = Reply::find($id);

        Session::flash('success', 'You unliked '.$reply->user->name.' reply');

        return redirect()->back();

    }

    public function best_answer($reply_id)
    {
        $reply = Reply::find($reply_id);

        $reply->best_answer = 1;

        $reply->user->points += 100;

        $reply->user->save();

        $reply->save();

        Session::flash('success', 'Reply has been marked as the best answer');

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('replies.edit')->with('reply', Reply::find($id));
    }

    public function update($id)
    {
        $this->validate(\request(), [
           'content' => 'required'
        ]);

        $reply = Reply::find($id);

        $reply->content = request()->content;

        $reply->save();

        if(request()->hasFile('r_img'))
        {
            $img = request()->r_img;
            $img_new_name = time().$img->getClientOriginalName();
            $img->move('uploads/replies/', $img_new_name);

            $reply->img = 'uploads/replies/'.$img_new_name;

            $reply->save();
        }

        Session::flash('success', 'Reply updated successfully');

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug]);

    }
}
