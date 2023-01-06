<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::support.support_ticket_nr', ['ticket' => $supportTicket->id]) }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $supportTicket->title }}</h4>
            <p class="card-text">
                {!! nl2br($supportTicket->body) !!}
            </p>
            <a href="#delete" style="color: rgb(184, 4, 4);" onclick="event.preventDefault(); document.deleteSt{{ $supportTicket->id }}Form.submit();">Remove</a>
            
            <form name="deleteSt{{$supportTicket->id}}Form" action="{{ route('livecontrols.support.delete', ['supportTicket' => $supportTicket->id]) }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
            <br>
            <small class="text-muted">{{ __('livecontrols::support.user_at_datetime', ['user' => $supportTicket->user->name, 'dateTime' => $supportTicket->created_at->format(__('livecontrols::general.date_time_format'))]) }}</small>
            <hr>
            @if(auth()->user()->support_team && !$supportTicket->closed)
                @livewire('livecontrols-support-status', ['supportTicket' => $supportTicket], key('support-status'))
            @elseif($supportTicket->closed && (auth()->user()->support_team || auth()->user()->can_reopen_ticket))
                <a class="btn btn-primary text-white" href="{{ route('livecontrols.support.reopen', ['supportTicket' => $supportTicket]) }}">{{ __('livecontrols::support.reopen') }}</a>
            @else
                {{ __('livecontrols::support.status') }}: {{ $supportTicket->status_string }}
            @endif
            <hr>
            <strong>{{ __('livecontrols::support.messages') }}:</strong>
            @livewire('livecontrols-support-messages', ['supportTicket' => $supportTicket], key('support-messages'))
        </div>
    </div>

</x-app-layout>