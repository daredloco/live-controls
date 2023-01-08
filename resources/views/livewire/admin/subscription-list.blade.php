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
                    <th scope="col">{{ __('livecontrols::subscription.value') }}</th>
                    <th scope="col">{{ __('livecontrols::subscription.duration_in_days') }}</th>
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

</div>