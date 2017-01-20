<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\postModel;
class footerMenuModel extends Model
{
 protected $table ="tbl_footer_menu";
    
    /***
     * get menu post and there details
     */
    public function getPostDetail(){
     
        return $this->belongsTo('App\postModel', 'post_id', 'id');
    }
    
}
