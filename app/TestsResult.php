<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestsResult extends Model
{

    protected $fillable = ['test_id', 'user_id', 'test_result'];

    public function answers()
    {
        return $this->hasMany('App\TestsResultsAnswer');
    }

}
