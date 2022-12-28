<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Support Tickets') }}
        </h2>
    </x-slot>

    <div class="col-md-6">
        @foreach($supportTickets as $supportTicket)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $supportTicket->title }}</h4>
                    <p class="card-text">
                        Status: {{ $supportTicket->status }}<br>
                        Latest Update: {{ $supportTicket->updated_at->format('d.m.Y H:i:s')}}<br>
                        <small class="text-muted">{{ $supportTicket->user->name.' at '.$supportTicket->created_at->format('d.m.Y H:i:s') }}</small>
                    </p>
                    <a href="{{ route('livecontrols.support.show', ['supportTicket' => $supportTicket->id]) }}" class="stretched-link">&nbsp;</a>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>