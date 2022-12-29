<div>
    <!-- SWEET ALERT 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
    //NEW SYSTEM
    window.addEventListener('popup', event => {
        Livewire.emit('popupSent', event.detail);
    });

    Livewire.on('showPopup', popupArr => {
        if(popupArr["inputFields"] !== false){
            //WITH INPUT
            Swal.fire({
                title: popupArr["title"],
                text: popupArr["message"],
                html: popupArr["html"],
                icon: popupArr["type"],
                timer: popupArr["timer"],
                timerProgressBar: popupArr["timerProgressBar"],
                showConfirmButton: popupArr["confirmButtonText"] == null ? false : true,
                showDenyButton: popupArr["denyButtonText"] == null ? false : true,
                showCancelButton: popupArr["cancelButtonText"] == null ? false : true,
                confirmButtonText: popupArr["confirmButtonText"] == null ? '' : popupArr["confirmButtonText"],
                denyButtonText: popupArr["denyButtonText"] == null ? '' : popupArr["denyButtonText"],
                cancelButtonText: popupArr["cancelButtonText"] == null ? '' : popupArr["cancelButtonText"],
                imageUrl: popupArr["imageUrl"],
                imageHeight: popupArr["imageHeight"],
                imageWidth: popupArr["imageWidth"],
                imageAlt: popupArr["imageAlt"],
                focusConfirm: false
            }).then((result) => { 
                if(result.isConfirmed){
                    let results = new Map();
                    popupArr["inputFields"].forEach(function callback(value, index){
                        results.set(value["name"], document.getElementById(value["name"]).value);
                    });
                    Livewire.emit(popupArr["confirmEvent"], Object.fromEntries(results));
                }else if (result.isDenied){
                    Livewire.emit(popupArr["denyEvent"]);
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit(popupArr["cancelEvent"]);
                    }
                }
            });
        }else{
            //WITHOUT INPUT
            Swal.fire({
                title: popupArr["title"],
                text: popupArr["message"],
                html: popupArr["html"],
                icon: popupArr["type"],
                timer: popupArr["timer"],
                timerProgressBar: popupArr["timerProgressBar"],
                showConfirmButton: popupArr["confirmButtonText"] == null ? false : true,
                showDenyButton: popupArr["denyButtonText"] == null ? false : true,
                showCancelButton: popupArr["cancelButtonText"] == null ? false : true,
                confirmButtonText: popupArr["confirmButtonText"] == null ? '' : popupArr["confirmButtonText"],
                denyButtonText: popupArr["denyButtonText"] == null ? '' : popupArr["denyButtonText"],
                cancelButtonText: popupArr["cancelButtonText"] == null ? '' : popupArr["cancelButtonText"],
                imageUrl: popupArr["imageUrl"],
                imageHeight: popupArr["imageHeight"],
                imageWidth: popupArr["imageWidth"],
                imageAlt: popupArr["imageAlt"]
            }).then((result) => { 
                if(result.isConfirmed){
                    Livewire.emit(popupArr["confirmEvent"]);
                }else if (result.isDenied){
                    Livewire.emit(popupArr["denyEvent"]);
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit(popupArr["cancelEvent"]);
                    }
                }
            });
        }
    });

    @if($hasPopup)
        @if($inputFields !== false)
            alert('Inputfields not supported in this version due to exceptions');
            Swal.fire({
                title: "{{ $title }}",
                text: "{{ $message }}",
                html: @js($html),
                icon: "{{ $type }}",
                showConfirmButton: {{ $confirmButtonText == null ? 'false' : 'true' }},
                showDenyButton: {{ $denyButtonText == null ? 'false' : 'true' }},
                showCancelButton: {{ $cancelButtonText == null ? 'false' : 'true' }},
                confirmButtonText: "{{ $confirmButtonText }}",
                denyButtonText: "{{ $denyButtonText }}",
                cancelButtonText: "{{ $cancelButtonText }}",
                imageUrl: "{{ $imageUrl }}",
                imageHeight: {{ $imageHeight == null ? 'null' : $imageHeight }},
                imageWidth: {{ $imageWidth == null ? 'null' : $imageWidth }},
                imageAlt: "{{ $imageAlt }}",
                focusConfirm: false
            });
        @else
            Swal.fire({
                title: "{{ $title }}",
                text: "{{ $message }}",
                html: "{{ $html }}",
                icon: "{{ $type }}",
                timer: {{ $timer == null ? 'null' : $timer }},
                timerProgressBar: {{ $timerProgressBar == null ? 'false' : 'true' }},
                showConfirmButton: {{ $confirmButtonText == null ? 'false' : 'true' }},
                showDenyButton: {{ $denyButtonText == null ? 'false' : 'true' }},
                showCancelButton: {{ $cancelButtonText == null ? 'false' : 'true' }},
                confirmButtonText: "{{ $confirmButtonText }}",
                denyButtonText: "{{ $denyButtonText }}",
                cancelButtonText: "{{ $cancelButtonText }}",
                imageUrl: "{{ $imageUrl }}",
                imageHeight: {{ $imageHeight == null ? 'null' : $imageHeight }},
                imageWidth: {{ $imageWidth == null ? 'null' : $imageWidth }},
                imageAlt: "{{ $imageAlt }}"
            }).then((result) => { 
                if(result.isConfirmed){
                    Livewire.emit('{{ $confirmEvent }}');
                }else if (result.isDenied){
                    Livewire.emit('{{ $denyEvent }}');
                }else if(result.isDismissed){
                    if(result.dismiss == Swal.DismissReason.cancel){
                        Livewire.emit('{{ $cancelEvent }}');
                    }
                }
            });
        @endif


    @else
    //OLD SYSTEM
        @if(Session::has('success'))
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false
            });
        @endif

        @if(Session::has("warning"))
            Swal.fire({
                title: "Warning!",
                text: "{{ session('warning') }}",
                icon: "warning",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false
            });
        @endif

        @if(Session::has("exception"))
            Swal.fire({
                title: "Error!",
                text: "{{ session('exception') }}",
                icon: "error",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false
            });
        @endif

        @if(Session::has("info"))
            Swal.fire({
                title: "Info!",
                text: "{{ session('info') }}",
                icon: "info",
                showConfirmButton: false,
                showDenyButton: false,
                showCancelButton: false
            });
        @endif

        window.addEventListener('showToast', toastarr => {
            if(toastarr["detail"][0] == "success"){
                Swal.fire({
                    title: 'Success!',
                    text: toastarr["detail"][1],
                    icon: "success",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false
                });
            }
            if(toastarr["detail"][0] == "warning"){
                Swal.fire({
                    title: 'Warning!',
                    text: toastarr["detail"][1],
                    icon: "warning",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false
                });
            }
            if(toastarr["detail"][0] == "exception"){
                Swal.fire({
                    title: 'Error!',
                    text: toastarr["detail"][1],
                    icon: "exception",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false
                });
            }
            if(toastarr["detail"][0] == "info"){
                Swal.fire({
                    title: 'Information',
                    text: toastarr["detail"][1],
                    icon: "info",
                    showConfirmButton: false,
                    showDenyButton: false,
                    showCancelButton: false
                });
            }
        });
    @endif
    
    </script>
    <!-- /SWEET ALERT 2 -->
</div>