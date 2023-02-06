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
                    <th scope="col">{{ __('livecontrols::general.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                    <tr class="">
                        <th scope="row">{{ $permission->id }}</th>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->key }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <a href="{{ route('livecontrols.admin.userpermissions.edit', ['userPermission' => $permission->id]) }}">{{ __('livecontrols::general.edit') }}</a> 
                            <a href="{{ route('livecontrols.admin.userpermissions.delete', ['userPermission' => $permission->id]) }}" onclick="event.preventDefault(); document.delete{{ $permission->id }}Form.submit();">{{ __('livecontrols::general.delete') }}</a>
                            <form name="delete{{$permission->id}}Form" action="{{ route('livecontrols.admin.userpermissions.delete', ['userPermission' => $permission->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $permissions->links() }}
    <a href="{{ route('livecontrols.admin.userpermissions.create') }}" class="btn btn-success text-white">{{ __('livecontrols::general.create') }}</a>

</div>