<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailUtility extends Model
{
    //
    public function masterutitlity(){
    	return $this->belongsTo('App\MasterUtility');
    }
}
