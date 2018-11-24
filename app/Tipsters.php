<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Tipsters extends Model {

    

    

    protected $table    = 'tipsters';
    
    protected $fillable = [
          'name',
          'image',
          'view_count',
          'win_rate'
    ];
    

    public static function boot()
    {
        parent::boot();

        Tipsters::observe(new UserActionsObserver);
    }
    
    
    
    
}