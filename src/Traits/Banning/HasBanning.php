<?php

namespace Helvetiapps\LiveControls\Traits\Banning;

use Carbon\Carbon;
use Helvetiapps\LiveControls\Models\Banning\Ban;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasBanning
{
    public function ban(): HasOne
    {
        return $this->hasOne(Ban::class);
    }

    public function isBanned(): bool
    {
        if(config('livecontrols.banning_enabled', false)){
            return !is_null($this->ban);
        }   
        false;
    }

    public function doBan(Carbon $banned_until = null): bool
    {
        $ban = new Ban();
        $ban->banned_until = $banned_until;
        $ban->email = $this->email;
        $ban->name = $this->name;
        return $this->ban()->save($ban) === false ? false : true;
    }

    public function doUnban(): bool
    {
        return $this->ban()->delete();
    }
}