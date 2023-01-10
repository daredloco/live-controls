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
                    <th scope="col">{{ __('livecontrols::subscriptions.value') }}</th>
                    <th scope="col">{{ __('livecontrols::subscriptions.duration_in_days') }}</th>
                    <th scope="col">{{ __('livecontrols::general.description') }}</th>
                    <th scope="col">{{ __('livecontrols::general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                    <tr class="">
                        <th scope="row">{{ $subscription->id }}</th>
                        <td>{{ $subscription->name }}</td>
                        <td>{{ $subscription->key }}</td>
                        <td>{{ number_format($subscription->value_in_cents / 100,2,',','.') }}</td>
                        <td>{{ $subscription->duration_in_days }}</td>
                        <td>{{ $subscription->description }}</td>
                        <td>
                            @if(config('livecontrols.userpermissions_enabled', false))
                                <a href="#" wire:click.prevent='editPermissions({{$subscription->id}})'>{{ __('livecontrols::admin.permissions') }}</a> 
                            @endif
                            <a href="{{ route('livecontrols.admin.subscriptions.edit', ['subscription' => $subscription->id]) }}">{{ __('livecontrols::general.edit') }}</a> 
                            <a href="{{ route('livecontrols.admin.subscriptions.delete', ['subscription' => $subscription->id]) }}" onclick="event.preventDefault(); document.delete{{ $subscription->id }}Form.submit();">{{ __('livecontrols::general.delete') }}</a>
                            <form name="delete{{$subscription->id}}Form" action="{{ route('livecontrols.admin.subscriptions.delete', ['subscription' => $subscription->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('livecontrols.admin.subscriptions.create') }}" class="btn btn-success text-white">{{ __('livecontrols::general.create') }}</a>

    @if(config('livecontrols.userpermissions_enabled', false))
    <!-- Permissions Modal -->
    <x-jet-dialog-modal wire:model="showPermissionModal">
        <x-slot name="title">
            {{ __('livecontrols::general.edit_type', ['type' => 'livecontrols::admin.permissions']) }}
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
</div>