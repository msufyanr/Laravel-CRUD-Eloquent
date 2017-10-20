<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterUtility extends Model
{
    //
    public function detailutilities(){
    	return $this->hasMany('App\DetailUtility','utility_master_id','id');
    }
}
