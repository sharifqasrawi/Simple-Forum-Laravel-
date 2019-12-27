<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Discussion extends Model
{
    protected $fillable = ['user_id', 'channel_id', 'title', 'content', 'slug', 'img'];

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function being_watched()
    {
        $id = Auth::id();

        $watchers_ids = array();

        foreach ($this->watchers as $w):
            array_push($watchers_ids, $w->user_id);
        endforeach;

        if(in_array($id, $watchers_ids))
        {
            return true;
        }else{
            return false;
        }
    }

    public function has_best_answer()
    {
        $res = false;

        foreach ($this->replies as $reply)
        {
            if($reply->best_answer)
            {
                $res = true;
                break;
            }
        }

        return $res;
    }
}
