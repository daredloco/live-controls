<?php

namespace Helvetiapps\LiveControls\Console\UserPermissions;

use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Console\Command;
use App\Models\User;

class RemoveUserFromPermissionCommand extends Command
{
    protected $signature = 'livecontrols:unsetpermission';

    protected $description = 'Removes an user from an userpermission';

    public function handle()
    {
        $id = $this->ask('User ID');
        $groupkey = $this->ask('Permission Key');

        $user = User::find($id);
        $group = UserPermission::where('key', '=', $groupkey)->first();

        if(is_null($group)){
            $this->warn('Invalid Permission Key!');
            return;
        }
        if(is_null($user)){
            $this->warn('Invalid User ID!');
            return;
        }
        if(!$group->users()->where('users.id', '=', $id)->exists()){
            $this->warn('User does not have this permission!');
            return;
        }
        
        $group->users()->detach($id);

        $this->info('Removed user from permission!');
    }
}