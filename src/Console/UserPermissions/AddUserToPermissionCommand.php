<?php

namespace Helvetiapps\LiveControls\Console\UserPermissions;

use Illuminate\Console\Command;
use App\Models\User;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Helvetiapps\LiveControls\Models\UserPermissions\UserPermission;

class AddUserToPermissionCommand extends Command
{
    protected $signature = 'livecontrols:setpermission';

    protected $description = 'Adds an user/group to an userpermission';

    public function handle()
    {
        $choice = $this->choice('User or Group?',[
            'User',
            'Group'
        ]);

        if($choice == 'User'){
            //IS USER
            $id = $this->ask('User ID');
            $permissionkey = $this->ask('Permission Key');
    
            $user = User::find($id);
            $permission = UserPermission::where('key', '=', $permissionkey)->first();
    
            if(is_null($permission)){
                $this->warn('Invalid Permission Key!');
                return;
            }
            if(is_null($user)){
                $this->warn('Invalid User ID!');
                return;
            }
    
            if($permission->users()->where('users.id', '=', $id)->exists()){
                $this->warn('User already has permission!');
                return;
            }
    
            $permission->users()->attach($id);
    
            $this->info('Added user to permission!');
        }elseif($choice == 'Group'){
            //IS GROUP
            $key = $this->ask('Group Key');
            $permissionkey = $this->ask('Permission Key');

            $group = UserGroup::where('key', '=', $key)->first();
            $permission = UserPermission::where('key', '=', $permissionkey)->first();

            if(is_null($permission)){
                $this->warn('Invalid Permission Key!');
                return;
            }
            if(is_null($group)){
                $this->warn('Invalid Group Key!');
                return;
            }

            if($permission->groups()->where('user_groups.key', '=', $key)->exists()){
                $this->warn('Group already has permission!');
                return;
            }

            $permission->groups()->attach($group->id);

            $this->info('Added group to permission!');
        }
        
    }
}