<div>
    <div class="mb-3">
      <input type="text"
        class="form-control" name="msg_title" id="msg_title" placeholder="{{ __('livecontrols::general.title') }}" wire:model='newTitle'>
    </div>
    <div class="mb-3">
      <textarea class="form-control" name="msg_body" id="msg_body" rows="3" wire:model='newBody' placeholder="{{ __('livecontrols::support.write_message') }}"></textarea>
    </div>
    <button class="btn btn-success text-white" wire:click='sendMessage' @if($supportTicket->status > 3) disabled @endif>{{ __('livecontrols::general.send') }}</button>
    <hr>
    <ul class="list-group">
        @foreach($supportMessages as $supportMessage)
            <li class="list-group-item">
                @if(!is_null($supportMessage->title) && $supportMessage->title != '')
                    <p><strong>{{ $supportMessage->title }}</strong></p>
                @endif

                {!! nl2br($supportMessage->body) !!}
                <hr>
                @if(auth()->id() == $supportMessage->user_id || auth()->user()->support_team)
                <a href="#" wire:click.prevent='removeMessage({{$supportMessage->id}})' style="color: rgb(184, 4, 4);">{{ __('livecontrols::general.remove') }}</a>
                <br>
                @endif
                <small class="text-muted">{{ __('livecontrols::support.user_at_datetime', ['user' => $supportMessage->user->name, 'dateTime' => $supportMessage->created_at->format(__('livecontrols::general.date_time_format'))]) }}</small>
            </li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-center">
        {{ $supportMessages->links() }}
    </div>
</div>