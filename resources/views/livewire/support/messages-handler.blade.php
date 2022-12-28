<div>
    <div class="mb-3">
      <input type="text"
        class="form-control" name="msg_title" id="msg_title" placeholder="Title" wire:model='newTitle'>
    </div>
    <div class="mb-3">
      <textarea class="form-control" name="msg_body" id="msg_body" rows="3" wire:model='newBody' placeholder="Write your message..."></textarea>
    </div>
    <button class="btn btn-success text-white" wire:click='sendMessage'>Send</button>
    <hr>
    <ul class="list-group">
        @foreach($supportMessages as $supportMessage)
            <li class="list-group-item">
                {{ !is_null($supportMessage->title) && $supportMessage->title != '' ? '<p><strong>'.$supportMessage->title.'</strong></p>' : '' }}
                {!! nl2br($supportMessage->body) !!}
                <hr>
                <small class="text-muted">{{ $supportMessage->user->name.' at '.$supportMessage->created_at->format('d.m.Y H:i:s') }}</small>
            </li>
        @endforeach
    </ul>
</div>