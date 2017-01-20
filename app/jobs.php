<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobs extends Model {

    protected $table = "tbl_job_opening";

    /*     * *
     * Get Category Details
     */

    public function getJobCategoryDetails() {
        return $this->belongsTo('App\jobCategories', 'category_id', 'id');
    }

}
