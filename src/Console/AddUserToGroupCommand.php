<?php

namespace Helvetiapps\LiveControls\Console;

use Helvetiapps\LiveControls\Models\UserGroups\UserGroup;
use Illuminate\Console\Command;
use App\Models\User;

class AddUserToGroupCommand extends Command
{
    protected $signature = 'livecontrols:setgroup';

    protected $description = 'Adds an user to an usergroup';

    public function handle()
    {
        $id = $this->ask('User ID');
        $groupkey = $this->ask('Group Key');

        $user = User::find($id);
        $group = UserGroup::where('key', '=', $groupkey)->first();

        if(is_null($group)){
            $this->warn('Invalid Group Key!');
            return;
        }
        if(is_null($user)){
            $this->warn('Invalid User ID!');
            return;
        }
        
        $group->users()->attach($id);

        $this->info('Added user to group!');
    }
}