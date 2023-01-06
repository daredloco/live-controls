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
                    <th scope="col">{{ __('livecontrols::general.key') }}</th>
                    <th scope="col">{{ __('livecontrols::general.description') }}</th>
                    <th scope="col">{{ __('livecontrols::general.color') }}</th>
                    <th scope="col">{{ __('livecontrols::general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr class="">
                        <th scope="row">{{ $group->id }}</th>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->key }}</td>
                        <td>{{ $group->description }}</td>
                        <td style="background-color: {{ $group->color }}"></td>
                        <td>
                            
                            @if(config('livecontrols.userpermissions_enabled', false))
                                <a href="#" wire:click.prevent='editPermissions({{$group->id}})'>{{ __('livecontrols::admin.permissions') }}</a> 
                            @endif
                            <a href="{{ route('livecontrols.admin.usergroups.edit', ['userGroup' => $group->id]) }}">{{ __('livecontrols::general.edit') }}</a> 
                            <a href="{{ route('livecontrols.admin.usergroups.delete', ['userGroup' => $group->id]) }}" onclick="event.preventDefault(); document.delete{{ $group->id }}Form.submit();">{{ __('livecontrols::general.delete') }}</a>
                            <form name="delete{{$group->id}}Form" action="{{ route('livecontrols.admin.usergroups.delete', ['userGroup' => $group->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('livecontrols.admin.usergroups.create') }}" class="btn btn-success text-white">{{ __('livecontrols::general.create') }}</a>

    @if(config('livecontrols.userpermissions_enabled', false))
    <!-- Permissions Modal -->
    <x-jet-dialog-modal wire:model="showPermissionModal">
        <x-slot name="title">
            {{ __('livecontrols::general.edit_type', ['type' => __('livecontrols::admin.permissions')])}}
        </x-slot>
    
        <x-slot name="content">
            @if(!is_null($itemToEdit))
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
</div>