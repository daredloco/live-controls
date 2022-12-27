<div>
    @push('styles')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush
    
    <!-- ToastR Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.options = {
                "positionClass": "toast-top-center"
            }
            toastr["success"]("{{ session('success') }}", "{{ __('Success') }}")
        @endif
        @if(Session::has('exception'))
            toastr.options = {
                "positionClass": "toast-top-center"
            }
            toastr["error"]("{{ session('exception') }}", "{{ __('Error') }}")
        @endif
        @if(Session::has('info'))
            toastr.options = {
                "positionClass": "toast-top-center"
            }
            toastr["info"]("{{ session('info') }}", "{{ __('Info') }}")
        @endif

        window.addEventListener('showToast', toastarr => {

            if(toastarr["detail"][0] == "success"){
                toastr.options = {
                "positionClass": "toast-top-center"
                }
                toastr["success"](toastarr["detail"][1], "{{ __('Success') }}")
            }
            if(toastarr["detail"][0] == "exception"){
                toastr.options = {
                "positionClass": "toast-top-center"
                }
                toastr["error"](toastarr["detail"][1], "{{ __('Error') }}")
            }
            if(toastarr["detail"][0] == "info"){
                toastr.options = {
                    "positionClass": "toast-top-center"
                }
                toastr["info"](toastarr["detail"][1], "{{ __('Info') }}")
            }
        })
    </script>
    <!-- /ToastR Script -->
</div>