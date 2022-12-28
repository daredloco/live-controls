<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Support') }}
        </h2>
    </x-slot>

    <div class="col-md-6">
        <a class="btn btn-primary text-white" href="{{ route('livecontrols.support.create') }}">Open new Ticket</a>
        @foreach($supportTickets as $supportTicket)
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">{{ $supportTicket->title }}</h4>
                    <p class="card-text">
                        Status: {{ $supportTicket->status }}<br>
                        Latest Update: {{ $supportTicket->updated_at->format('d.m.Y') }}
                    </p>
                    <a href="{{ route('livecontrols.support.show', ['supportTicket' => $supportTicket->id]) }}" class="stretched-link">&nbsp;</a>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>