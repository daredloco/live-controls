<div>
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." wire:model='search'>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->id != config('livecontrols.admininterface_master') || $user->id == auth()->id())
                                <a href="#" wire:click.prevent='editPermissions({{$user->id}})'>Permissions</a> 
                                <a href="#" wire:click.prevent='editGroups({{$user->id}})'>Groups</a>
                                @if($editRoute !== false)
                                    <a href="{{ $editRoute }}">Edit</a> 
                                @endif

                                @if($deleteRoute !== false)
                                    <a href="{{ $deleteRoute }}">Delete</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($createRoute !== false)
        <a href="{{ route(config('livecontrols.routes_users')['create']) }}" class="btn btn-success text-white">Create</a>
    @endif

    <!-- Permissions Modal -->
    <x-jet-dialog-modal wire:model="showPermissionModal">
        <x-slot name="title">
            Edit Permissions
        </x-slot>
    
        <x-slot name="content">
            @if($showPermissionModal === true)
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" value="1" id="perm-{{ $permission->id }}" wire:click='updatePermission({{$permission->id}})'
                        @if(in_array($permission->id, $itemPermissions)) checked @endif>
                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showPermissionModal')" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Permissions Modal -->

    <!-- Groups Modal -->
    <x-jet-dialog-modal wire:model="showGroupModal">
        <x-slot name="title">
            Edit Groups
        </x-slot>
    
        <x-slot name="content">
            @if($showGroupModal === true)
                @foreach($groups as $group)
                    <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" value="1" id="perm-{{ $group->id }}" wire:click='updateGroup({{$group->id}})'
                        @if(in_array($group->id, $itemGroups)) checked @endif>
                        <label class="form-check-label" for="perm-{{ $group->id }}">
                            {{ $group->name }}
                        </label>
                    </div>
                @endforeach
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showGroupModal')" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Groups Modal -->
</div>