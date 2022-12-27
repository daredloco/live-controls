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
                            @if($editRoute !== false)
                                <a href="{{ $editRoute }}">Edit</a> 
                            @endif

                            @if($deleteRoute !== false)
                                <a href="{{ $deleteRoute }}">Delete</a>
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
</div>