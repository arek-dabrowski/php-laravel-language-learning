<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    public $primaryKey = 'id';
    public $timestamps = false;

    public function sets(){
        return $this->hasMany('App\Set');
    }

    public function authorizations(){
        return $this->hasMany('App\Authorization');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
