<div>
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="{{ __('livecontrols::general.search') }}" aria-label="{{ __('livecontrols::general.search') }}" wire:model='search'>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{ __('livecontrols::general.id') }}</th>
                    <th scope="col">{{ __('livecontrols::general.name') }}</th>
                    <th scope="col">{{ __('livecontrols::general.email') }}</th>
                    <th scope="col">{{ __('livecontrols::general.actions') }}</th>
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
                                @if(config('livecontrols.userpermissions_enabled', false))
                                    <a href="#" wire:click.prevent='editPermissions({{$user->id}})'>{{ __('livecontrols::admin.permissions') }}</a> 
                                @endif
                                @if(config('livecontrols.usergroups_enabled', false))
                                    <a href="#" wire:click.prevent='editGroups({{$user->id}})'>{{ __('livecontrols::admin.groups') }}</a>
                                @endif
                                @if(config('livecontrols.subscriptions_enabled', false))
                                    <a href="#" wire:click.prevent='editSubscriptions({{$user->id}})'>{{ __('livecontrols::admin.subscriptions') }}</a>
                                @endif
                                @if($editRoute !== false)
                                    <a href="{{ route(config('livecontrols.routes_users')['edit'], ['user' => $user->id]) }}">{{ __('livecontrols::general.edit') }}</a> 
                                @endif

                                @if($deleteRoute !== false)
                                    <a href="{{ route(config('livecontrols.routes_users')['delete']) }}" onclick="event.preventDefault(); document.delete{{ $user->id }}Form.submit();">{{ __('livecontrols::general.delete') }}</a>
                                    <form name="delete{{$user->id}}Form" action="{{ route(config('livecontrols.routes_users')['delete'], ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>  
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($createRoute !== false)
        <a href="{{ route(config('livecontrols.routes_users')['create']) }}" class="btn btn-success text-white">{{ __('livecontrols::general.create') }}</a>
    @endif

    @if(config('livecontrols.userpermissions_enabled', false))
    <!-- Permissions Modal -->
    <x-jet-dialog-modal wire:model="showPermissionModal">
        <x-slot name="title">
            {{ __('livecontrols::general.edit_type', ['type' => __('livecontrols::admin.permissions')]) }}
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
                {{ __('livecontrols::general.close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Permissions Modal -->
    @endif

    @if(config('livecontrols.usergroups_enabled', false))
    <!-- Groups Modal -->
    <x-jet-dialog-modal wire:model="showGroupModal">
        <x-slot name="title">
            {{ __('livecontrols::general.edit_type', ['type' => __('livecontrols::admin.groups')]) }}
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
                {{ __('livecontrols::general.close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Groups Modal -->
    @endif

    @if(config('livecontrols.subscriptions_enabled', false))
    <!-- Subscriptions Modal -->
    <x-jet-dialog-modal wire:model="showSubscriptionsModal">
        <x-slot name="title">
            {{ __('livecontrols::general.edit_type', ['type' => __('livecontrols::admin.subscriptions')]) }}
        </x-slot>
    
        <x-slot name="content">
            @if($showSubscriptionsModal === true)
                @foreach($subscriptions as $subscription)
                    <div class="form-check">
                        <input class="form-check-input" 
                        type="checkbox" value="1" id="perm-{{ $subscription->id }}" wire:click='updateSubscription({{$subscription->id}})'
                        @if(in_array($subscription->id, $itemSubscriptions)) checked @endif>
                        <label class="form-check-label" for="perm-{{ $subscription->id }}">
                            {{ $subscription->name }}
                        </label>
                    </div>
                @endforeach
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showSubscriptionsModal')" wire:loading.attr="disabled">
                {{ __('livecontrols::general.close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Subscriptions Modal -->
    @endif
</div>