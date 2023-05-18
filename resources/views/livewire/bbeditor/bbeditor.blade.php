<div>
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    @endpush

    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
    @if(!is_null($locale))
        <script src="https://cdn.jsdelivr.net/npm/sceditor@3/languages/{{ $locale }}.js"></script>
    @endif


      <textarea name="{{ $areaid }}" id="{{ $areaid }}" class="form-control" style="height: 350px;"></textarea>

      @if($savebutton)
        <button wire:click='save' class="mt-2 btn btn-success text-white">{{ $savebuttontext }}</button>
      @else
        <input type="hidden" id="{{ $hiddeninputid }}" name="{{ $hiddeninputid }}">
      @endif
    <script>

        var textarea{{ $areaid }} = document.getElementById('{{ $areaid }}');
        sceditor.create(textarea{{ $areaid }}, {
            format: 'bbcode',
            style: '{{ $theme }}',
            emoticonsEnabled: false,
            resizeEnabled: false,
            toolbar: "bold,italic,underline,strike|subscript,superscript|left,center,right,justify|size,color,removeformat|cut,copy,paste|image,bulletlist,orderedlist|horizontalrule|email,link,unlink|date|time|ltr,rtl",
            dateFormat: "{{ $dateFormat }}",
            autoUpdate: false,
            enablePasteFiltering: true
        });

        window.scInstance = sceditor.instance(textarea{{ $areaid }}); //This can most likely be removed...

        sceditor.instance(textarea{{ $areaid }}).blur(function(){
            @if($savebutton)
                @this.content = sceditor.instance(textarea{{ $areaid }}).val();
            @else
                document.getElementById('{{ $hiddeninputid }}').value = sceditor.instance(textarea{{ $areaid }}).val();
            @endif

            @if(!is_null($blurEvent))
                Livewire.emit('{{ $blurEvent }}', [sceditor.instance(textarea{{ $areaid }}).val()]);
            @endif
        });

        @if($oldcontent != null)
            document.addEventListener("DOMContentLoaded", function(event) {
                sceditor.instance(textarea{{ $areaid }}).keyDown(function(e) {
                    if(e.keyCode == 116 || e.keyCode == 32 || e.keyCode == 13){ return; }
                });
                setTimeout(function () {
                        sceditor.instance(textarea{{ $areaid }}).insert('{!! str_replace(["\r", "\n"], ['\\r', '\\n'], $oldcontent) !!}');
                }, 10);
            }, false);
        @else
            document.addEventListener("DOMContentLoaded", function(event) {
                sceditor.instance(textarea{{ $areaid }}).keyDown(function(e) {
                    if(e.keyCode == 116 || e.keyCode == 32 || e.keyCode == 13){ return; }
                });
            },false);
        @endif
    </script>
</div>
