<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postModel;
class headerMenuModel extends Model
{
    protected $table ="tbl_menus";
    
    /***
     * get menu post and there details
     */
    public function getPostDetail(){
     
        return $this->belongsTo('App\postModel', 'post_id', 'id');
    }
    
    
}
