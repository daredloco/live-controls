<div>
    <div class="mb-3">
      <input type="text"
        class="form-control" name="msg_title" id="msg_title" placeholder="{{ __('Title') }}" wire:model='newTitle'>
    </div>
    <div class="mb-3">
      <textarea class="form-control" name="msg_body" id="msg_body" rows="3" wire:model='newBody' placeholder="{{ __('Write your message...') }}"></textarea>
    </div>
    <button class="btn btn-success text-white" wire:click='sendMessage'>{{ __('Send') }}</button>
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
                <a href="#" wire:click.prevent='removeMessage({{$supportMessage->id}})' style="color: rgb(184, 4, 4);">{{ __('Remove') }}</a>
                <br>
                @endif
                <small class="text-muted">{{ $supportMessage->user->name.' at '.$supportMessage->created_at->format(__('dateTimeFormat')) }}</small>
            </li>
        @endforeach
    </ul>

    <div class="d-flex justify-content-center">
        {{ $supportMessages->links() }}
    </div>
</div>