<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jobApplications extends Model {

    protected $table = "tbl_job_applications";

    
     /*     * *
     * Get JOBS Details
     */

    public function getJobsDetail() {
        return $this->hasOne('App\jobs', 'id', 'job_id');
    }
}
