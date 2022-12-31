<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::support.support_tickets') }}
        </h2>
    </x-slot>

    @if(count($supportTickets) < 1)
        <div class="alert alert-info text-center" role="alert">
            <strong>{{ __('livecontrols::support.no_support_tickets') }}</strong>
        </div>
    @endif

    <div class="col-md-6">
        @foreach($supportTickets as $supportTicket)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $supportTicket->title }}</h4>
                    <p class="card-text">
                        {{ __('livecontrols::support.status') }}: {{ $supportTicket->status_string }}<br>
                        {{ __('livecontrols::support.latest_update') }}: {{ $supportTicket->updated_at->format(__('livecontrols::general.date_time_format'))}}<br>
                        <small class="text-muted">{{ __('livecontrols::support.user_at_datetime', ['user' => $supportTicket->user->name, 'dateTime' => $supportTicket->created_at->format(__('livecontrols::general.date_time_format'))]) }}</small>
                    </p>
                    <a href="{{ route('livecontrols.support.show', ['supportTicket' => $supportTicket->id]) }}" class="stretched-link">&nbsp;</a>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $supportTickets->links() }}
    </div>
</x-app-layout>