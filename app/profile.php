<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
	protected $guarded=[];
    public function user(){
    	return $this->belongsTo('App\User');
    }
      public function followers(){
      return $this->belongsToMany('App\User');
    } 
    public function getImage(){
      	if($this->image){
      		return '/storage/' . $this->image;
      	}
        
          return '/storage/' . 'uploads/default.png';

    }
   
}
