<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WatchersController extends Controller
{
    public function watch($id)
    {
        Watcher::create([
           'discussion_id' => $id,
           'user_id' => Auth::id()
        ]);

        Session::flash('info', 'You are watching this discussion');

        return redirect()->back();
    }

    public function unwatch($id)
    {
        $watcher = Watcher::where('discussion_id', $id)->where('user_id', Auth::id());

        $watcher->delete();

        Session::flash('info', 'You are no longer watching this discussion');

        return redirect()->back();
    }
}
