<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Support Tickets') }}
        </h2>
    </x-slot>

    @if(count($supportTickets) < 1)
        <div class="alert alert-info text-center" role="alert">
            <strong>{{ __('No Support Tickets found!') }}</strong>
        </div>
    @endif

    <div class="col-md-6">
        @foreach($supportTickets as $supportTicket)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $supportTicket->title }}</h4>
                    <p class="card-text">
                        {{ __('Status') }}: {{ $supportTicket->status }}<br>
                        {{ __('Latest Update') }}: {{ $supportTicket->updated_at->format(__('dateTimeFormat'))}}<br>
                        <small class="text-muted">{{ $supportTicket->user->name.' at '.$supportTicket->created_at->format(__('dateTimeFormat')) }}</small>
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