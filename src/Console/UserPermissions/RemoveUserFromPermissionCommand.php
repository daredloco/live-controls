<?php

namespace Helvetiapps\LiveControls\Console\UserPermissions;

use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;
use Illuminate\Console\Command;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;

class RemoveUserFromPermissionCommand extends Command
{
    protected $signature = 'livecontrols:unsetpermission';

    protected $description = 'Removes an user/group from an userpermission';

    public function handle()
    {
        $choice = $this->choice('User or Group?',[
            'User',
            'Group'
        ]);

        if($choice == 'User'){
            //IS USER
            $id = $this->ask('User ID');
            $permissionKey = $this->ask('Permission Key');

            $user = User::find($id);
            if(is_null($user)){
                $this->warn('Invalid User ID!');
                return;
            }

            $group = UserPermission::where('key', '=', $permissionKey)->first();

            if(is_null($group)){
                $this->warn('Invalid Permission Key!');
                return;
            }

            if(!$group->users()->where('users.id', '=', $id)->exists()){
                $this->warn('User does not have this permission!');
                return;
            }
            
            $group->users()->detach($id);

            $this->info('Removed user from permission!');
        }elseif($choice == 'Group'){
            //IS GROUP
            $key = $this->ask('Group Key');
            $permissionKey = $this->ask('Permission Key');

            $group = UserGroup::where('key', '=', $key)->first();
            if(is_null($group)){
                $this->warn('Invalid Group Key!');
                return;
            }

            $permission = UserPermission::where('key', '=', $permissionKey)->first();

            if(is_null($permission)){
                $this->warn('Invalid Permission Key!');
                return;
            }

            if(!$permission->groups()->where('user_groups.key', '=', $key)->exists()){
                $this->warn('Group does not have this permission!');
                return;
            }
            
            $permission->groups()->detach($group->id);

            $this->info('Removed group from permission!');
        }
    }
}