<div>
    Selected Image: {{ $selectedItem }}
    @foreach($items as $modelsContent)
    <div class="card shadow-lg mt-3 col-md-3">
        <div class="card-body">
            <h4>{{ $modelsContent["name"] }}</h4>
            @foreach($modelsContent["items"] as $item)
            <hr>
                ID: {{ $item["id"] }}<br>
                Title: {{ $item["title"] }}<br>
                @foreach($item["columns"] as $columnName => $columnContent)
                <img src="{{ $columnContent["url"] }}" class="img-fluid"><br>
                <small class="text-muted">{{ $columnName }}</small>
                <div class="row">
                    <button class="btn btn-primary text-white" wire:click='select("{{ $columnContent["path"]}}")'>Select</button>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
    @endforeach
</div>