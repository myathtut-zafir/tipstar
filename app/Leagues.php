<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Leagues extends Model
{


    protected $table = 'leagues';

    protected $fillable = [
        'name',
        'country'
    ];


    public static function boot()
    {
        parent::boot();

        Leagues::observe(new UserActionsObserver);
    }

    public function teams()
    {
        return $this->hasMany('App\Teams');
    }


}