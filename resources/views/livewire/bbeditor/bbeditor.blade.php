<div>
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    @endpush

    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/formats/bbcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/languages/pt.js"></script>


      <textarea name="{{ $areaid }}" id="{{ $areaid }}" class="form-control" style="height: 350px;"></textarea>

      @if($savebutton)
        <button wire:click='save' class="mt-2 btn btn-success text-white">{{ $savebuttontext }}</button>
      @else
        <input type="hidden" id="{{ $hiddeninputid }}" name="{{ $hiddeninputid }}">
      @endif
    <script>

        var textarea = document.getElementById('{{ $areaid }}');
        sceditor.create(textarea, {
            format: 'bbcode',
            style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css',
            emoticonsEnabled: false,
            resizeEnabled: false,
            toolbar: "bold,italic,underline,strike|subscript,superscript|left,center,right,justify|size,color,removeformat|cut,copy,paste|image,bulletlist,orderedlist|horizontalrule|email,link,unlink|date|time|ltr,rtl",
            dateFormat: "day/month/year",
            autoUpdate: false,
            enablePasteFiltering: true
        });

        window.scInstance = sceditor.instance(textarea);

        window.scInstance.blur(function(){
            @if($savebutton)
                @this.content = window.scInstance.val();
            @else
                document.getElementById('{{ $hiddeninputid }}').value = window.scInstance.val();
            @endif
        });

        @if($oldcontent != null)
            document.addEventListener("DOMContentLoaded", function(event) {
                sceditor.instance(textarea).keyDown(function(e) {
                    if(e.keyCode == 116 || e.keyCode == 32 || e.keyCode == 13){ return; }
                });
                setTimeout(function () {
                        sceditor.instance(textarea).insert('{!! str_replace(["\r", "\n"], ['\\r', '\\n'], $oldcontent) !!}');
                }, 10);
            }, false);
        @else
            document.addEventListener("DOMContentLoaded", function(event) {
                sceditor.instance(textarea).keyDown(function(e) {
                    if(e.keyCode == 116 || e.keyCode == 32 || e.keyCode == 13){ return; }
                });
            },false);
        @endif
    </script>
</div>
