<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $table = 'authorizations';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function subcategory(){
        return $this->belongsTo('App\Subcategory');
    }
}
