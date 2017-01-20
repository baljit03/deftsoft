<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobCategories extends Model {

    protected $table = "tbl_job_categories";

    /*     * *
     * Get JOBS Details
     */

    public function getJobsByCategory() {
        return $this->hasMany('App\jobs', 'category_id', 'id');
    }

}
