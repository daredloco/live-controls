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
                    <th scope="col">Key</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                    <tr class="">
                        <th scope="row">{{ $group->id }}</th>
                        <td>{{ $group->name }} <span  class="rounded-circle" style="background-color: {{ $group->color }}; height: 12px; width: 12px;"></td>
                        <td>{{ $group->key }}</td>
                        <td>
                            <a href="{{ route('livecontrols.admin.usergroups.edit', ['userGroup' => $group->id]) }}">Edit</a> 
                            <a href="{{ route('livecontrols.admin.usergroups.delete', ['userGroup' => $group->id]) }}" onclick="event.preventDefault(); document.delete{{ $group->id }}Form.submit();">Delete</a>
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
    <a href="{{ route('livecontrols.admin.usergroups.create') }}" class="btn btn-success text-white">Create</a>

</div>