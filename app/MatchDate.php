<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchDate extends Model
{
    protected $table = "match_dates";

    public function matchDetail()
    {
        return $this->hasMany(MatchDetail::class);
    }
}
