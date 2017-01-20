<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postMetaModel extends Model
{
      protected $table = "tbl_postmeta";
        
      /***
     * Get Post Detail
     */
    
    public function getPostDetail(){
        return $this->belongsTo('App\postModel', 'id', 'id');
    }
}
