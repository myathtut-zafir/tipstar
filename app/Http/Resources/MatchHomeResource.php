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
            'tip_team' => $this->tip_team,
            'level' => $this->level,
            'home_team_logo' => $this->home_team_logo ?? "",
            'away_team_logo' => $this->away_team_logo ?? "",
            'tip_odd' => $this->tip_odd ?? "-0.5",
        ];
    }

}
