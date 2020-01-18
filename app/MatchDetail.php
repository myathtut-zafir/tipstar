<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchDetail extends Model
{
    protected $table = "match_details";

    public function matchDate()
    {
        return $this->belongsTo(MatchDate::class);
    }
}
