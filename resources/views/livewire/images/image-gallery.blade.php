<div>
    Selected Image: {{ $selectedItem }}
        @foreach($items as $modelsContent)
        <div class="card shadow-lg mt-3">
            <div class="card-body">
                <h4>{{ $modelsContent["name"] }}</h4>
                <div class="row">
                    @foreach($modelsContent["items"] as $item)
                    <div class="card col-md-3">
                        <div class="card-body">
                            ID: {{ $item["id"] }}<br>
                            Title: {{ $item["title"] }}<br>
                            @foreach($item["columns"] as $columnName => $columnContent)
                                @if(!is_null($columnContent["url"]))
                                    <img src="{{ $columnContent["url"] }}" class="img-fluid"><br>
                                    <small class="text-muted">{{ $columnName }}</small>
                                    <div class="row">
                                        <button class="btn btn-primary text-white" wire:click='select("{{ $columnContent["path"]}}")'>Select</button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>