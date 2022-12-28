<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Support Ticket #').$supportTicket->id }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $supportTicket->title }}</h4>
            <p class="card-text">
                {!! nl2br($supportTicket->body) !!}
            </p>
            <a href="{{ route('livecontrols.support.delete', ['supportTicket' => $supportTicket->id]) }}" style="color: rgb(184, 4, 4);">Remove</a>
            <br>
            <small class="text-muted">{{ $supportTicket->user->name.' at '.$supportTicket->created_at->format('d.m.Y H:i:s') }}</small>
            <hr>
            <strong>Messages:</strong>
            @livewire('livecontrols-support-messages', ['supportTicket' => $supportTicket], key('support-messages'))
        </div>
    </div>

</x-app-layout>