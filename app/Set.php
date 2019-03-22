<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $table = 'sets';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory');
    }

    public function results(){
        return $this->hasMany('App\Result');
    }
}
