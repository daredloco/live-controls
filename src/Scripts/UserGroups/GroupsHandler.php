<?php

namespace Helvetiapps\LiveControls\Scripts\UserGroups;

use App\Models\User;
use Exception;
use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;

class GroupsHandler
{
    public static function addUser(User|int $user, UserGroup|string|int $group){
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
           throw new Exception('Invalid user!');
        }
        if(is_numeric($group)){
            $group = UserGroup::find($group);
        }
        elseif(is_string($group)){
            $group = UserGroup::where('key', '=', $group)->first();
        }
        if(is_null($group)){
            throw new Exception('Invalid group!');
        }
        $user->groups()->attach($group->id);
    }

    public static function removeUser(User|int $user, UserGroup|string|int $group){
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
           throw new Exception('Invalid user!');
        }
        if(is_numeric($group)){
            $group = UserGroup::find($group);
        }
        elseif(is_string($group)){
            $group = UserGroup::where('key', '=', $group)->first();
        }
        if(is_null($group)){
            throw new Exception('Invalid group!');
        }
        $user->groups()->detach($group->id);
    }

    public static function toggleUser(User|int $user, UserGroup|string|int $group){
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
           throw new Exception('Invalid user!');
        }
        if(is_numeric($group)){
            $group = UserGroup::find($group);
        }
        elseif(is_string($group)){
            $group = UserGroup::where('key', '=', $group)->first();
        }
        if(is_null($group)){
            throw new Exception('Invalid group!');
        }
        if($user->groups->contains($group->id)){
            $user->groups()->detach($group->id);
            return;
        }
        $user->groups()->attach($group->id);
    }

    public static function inGroup(User|int $user, UserGroup|string|int|array $group):bool{
        if(is_numeric($user)){
            $user = User::find($user);
        }
        if(is_null($user)){
           throw new Exception('Invalid user!');
        }
        if(is_array($group)){
            if(is_numeric($group[0])){
                if($user->groups()->whereIn('user_group_id', $group)->count() > 0){
                    return true;
                }
            }
            elseif(is_string($group[0])){
                if($user->groups()->whereIn('livecontrols_user_groups.key', $group)->count() > 0){
                    return true;
                }
            }else{
                foreach($group as $singleGroup){
                    if(is_null($singleGroup)){
                        throw new Exception('Invalid group!');
                    }
                    if($user->groups()->where('user_group_id', '=', $singleGroup->id)->exists()){
                        return true;
                    }
                }
            }
            return false;
        }
        
        if(is_numeric($group)){
            $group = UserGroup::find($group);
        }
        elseif(is_string($group)){
            $group = UserGroup::where('key', '=', $group)->first();
        }
        if(is_null($group)){
            throw new Exception('Invalid group!');
        }
        return $user->groups()->where('user_group_id', '=', $group->id)->exists();
    }
}