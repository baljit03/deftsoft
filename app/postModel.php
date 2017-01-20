<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class postModel extends Model
{
    //
     protected $table = "tbl_posts";
   

    /***
     * Get Post Detail
     */
    
    public function getPostMeta(){
        return $this->hasMany('App\postMetaModel', 'post_id', 'id');
    }
    /****
     * Get post user information
     */
    public function UserInfo(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
