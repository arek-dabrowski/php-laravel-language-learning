<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function set(){
        return $this->belongsTo('App\Set');
    }
}
