<div>
    <div class="col-md-4">
        <input type="text" class="form-control" placeholder="{{ __('Search...') }}" aria-label="{{ __('Search...') }}" wire:model='search'>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Key') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">{{ __('Color') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
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
                            <a href="#" wire:click.prevent='editPermissions({{$group->id}})'>{{ __('Permissions') }}</a> 
                            <a href="{{ route('livecontrols.admin.usergroups.edit', ['userGroup' => $group->id]) }}">{{ __('Edit') }}</a> 
                            <a href="{{ route('livecontrols.admin.usergroups.delete', ['userGroup' => $group->id]) }}" onclick="event.preventDefault(); document.delete{{ $group->id }}Form.submit();">{{ __('Delete') }}</a>
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
    <a href="{{ route('livecontrols.admin.usergroups.create') }}" class="btn btn-success text-white">{{ __('Create') }}</a>

    <!-- Permissions Modal -->
    <x-jet-dialog-modal wire:model="showPermissionModal">
        <x-slot name="title">
            {{ __('Edit :type', ['type' => __('Permissions')])}}
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
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>    
    <!-- /Permissions Modal -->
</div>