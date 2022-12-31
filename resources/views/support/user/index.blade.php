<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::support.support') }}
        </h2>
    </x-slot>

    <div class="col-md-6">
        <a class="btn btn-primary text-white" href="{{ route('livecontrols.support.create') }}">{{ __('livecontrols::support.open_new_ticket') }}</a>
        @foreach($supportTickets as $supportTicket)
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">{{ $supportTicket->title }}</h4>
                    <p class="card-text">
                        {{ __('livecontrols::support.status') }}: {{ $supportTicket->status_string }}<br>
                        {{ __('livecontrols::support.latest_update') }}: {{ $supportTicket->updated_at->format(__('livecontrols::general.date_time_format')) }}
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