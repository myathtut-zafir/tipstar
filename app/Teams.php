<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Teams extends Model
{


    protected $table = 'teams';

    protected $fillable = [
        'team_name',
        'country',
        'city'
    ];


    public static function boot()
    {
        parent::boot();

        Teams::observe(new UserActionsObserver);
    }

    public function league()
    {
        return $this->belongsTo('App\Leagues');
    }


}