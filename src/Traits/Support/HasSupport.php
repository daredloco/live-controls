<?php

namespace Helvetiapps\LiveControls\Traits\Support;

use Helvetiapps\LiveControls\Models\Support\SupportTicket;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSupport{
    public function supportTickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class, 'user_id');
    }

    public function getSupportTicketsCountAttribute(): int{
        return $this->supportTickets()->count();
    }

    public function getOpenSupportTicketsCountAttribute(): int{
        return $this->supportTickets()->where('status', '=', 5)->count();
    }

    public function getSupportTeamAttribute(): bool{
        //Check if user is master
        if($this->id == config('livecontrols.admininterface_master')){
            return true;
        }

        //Check if group is admin or is in support_groups
        foreach($this->groups as $group){
            foreach(config('livecontrols.usergroups_admins') as $adminGroup){
                if($group->key == $adminGroup){
                    return true;
                }
            }
            foreach(config('livecontrols.support_groups') as $supportGroup){
                if($group->key == $supportGroup){
                    return true;
                }
            }
        }

        return false;
    }

    public function getCanReopenTicketAttribute(): bool{
        return config('livecontrols.support_reopen_ticket', false);
    }
}