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
                    <th scope="col">{{ __('Actions') }}</th>
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
                            <a href="{{ route('livecontrols.admin.userpermissions.edit', ['userPermission' => $permission->id]) }}">{{ __('Edit') }}</a> 
                            <a href="{{ route('livecontrols.admin.userpermissions.delete', ['userPermission' => $permission->id]) }}" onclick="event.preventDefault(); document.delete{{ $permission->id }}Form.submit();">{{ __('Delete') }}</a>
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
    <a href="{{ route('livecontrols.admin.userpermissions.create') }}" class="btn btn-success text-white">{{ __('Create') }}</a>

</div>