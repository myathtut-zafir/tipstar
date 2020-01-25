<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MatchHomeResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'league' => $this->league,
            'home_team' => $this->home_team,
            'away_team' => $this->away_team,
            'tip_team' => $this->tip_team,
            'level' => $this->level,
            'tip_odd' => $this->tip_odd,
        ];
    }

}
