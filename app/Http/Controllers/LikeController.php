<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
    /**
     *
     * A Reply has new like 
     * 
     * @param  Reply  $reply 
     * @return mixed        
     */
    public function like(Reply $reply)
    {
        $reply->like()->create(['user_id' => '1']);
    }

    /**
     *
     * A Reply lost a like 
     * 
     * @param  Reply  $reply 
     * @return mixed        
     */
    public function unLike(Reply $reply)
    {
        $reply->like()->where('user_id', 1)->first()->delete();
    }
}
