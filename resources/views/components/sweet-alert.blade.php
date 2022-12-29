<div>
    <!-- SWEET ALERT 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>






    <script type="text/javascript">
    @if($hasPopup)
        Swal.fire({
            title: "{{ $title }}",
            text: "{{ $message }}",
            icon: "{{ $type }}",
            showConfirmButton: {{ $confirmButtonText == null ? false : true }}
            showDenyButton: {{ $denyButtonText == null ? false : true }}
            showCancelButton: {{ $cancelButtonText == null ? false : true }}
            confirmButtonText: "{{ $confirmButtonText }}",
            denyButtonText: "{{ $denyButtonText }}",
            cancelButtonText: "{{ $cancelButtonText }}"
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
    @else
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