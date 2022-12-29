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
            confirmButtonText: {{ $confirmButtonText }},
            denyButtonText: {{ $denyButtonText }},
            cancelButtonText: {{ $cancelButtonText }}
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
            var toastTitle = null;
            var confirmButton = null;
            var denyButton = null;
            var cancelButton = null;

            var confirmEvent = null;
            var denyEvent = null;
            var cancelEvent = null;

            if("title" in toastarr){
                toastTitle = toastarr["title"];
            }
            if("confirmButton" in toastarr){
                confirmButton = toastarr["confirmButton"];
            }
            if("denyButton" in toastarr){
                denyButton = toastarr["denyButton"];
            }
            if("cancelButton" in toastarr){
                cancelButton = toastarr["cancelButton"];
            }
            if("confirmEvent" in toastarr){
                confirmEvent = toastarr["confirmEvent"];
            }
            if("denyEvent" in toastarr){
                denyEvent = toastarr["denyEvent"];
            }
            if("cancelEvent" in toastarr){
                cancelEvent = toastarr["cancelEvent"];
            }

            if(toastarr["detail"][0] == "success"){
                Swal.fire({
                    title: toastTitle == null ? 'Success!' : toastTitle,
                    text: toastarr["detail"][1],
                    icon: "success",
                    showConfirmButton: confirmButton == null ? false : true
                    showDenyButton: denyButton == null ? false : true
                    showCancelButton: cancelButton == null ? false : true
                    confirmButtonText: confirmButton,
                    denyButtonText: denyButton,
                    cancelButtonText: cancelButton
                }).then((result) => { 
                    if(result.isConfirmed){
                        if(confirmEvent != null){
                            Livewire.emit(confirmEvent);
                        }
                    }else if (result.isDenied){
                        if(denyEvent != null){
                            Livewire.emit(denyEvent);
                        }
                    }else if(result.isDismissed){
                        if(result.dismiss == Swal.DismissReason.cancel){
                            if(cancelEvent != null){
                                Livewire.emit(cancelEvent);
                            }
                        }
                    }
                });
            }
            if(toastarr["detail"][0] == "warning"){
                Swal.fire({
                    title: toastTitle == null ? 'Warning!' : toastTitle,
                    text: toastarr["detail"][1],
                    icon: "warning",
                    showConfirmButton: confirmButton == null ? false : true
                    showDenyButton: denyButton == null ? false : true
                    showCancelButton: cancelButton == null ? false : true
                    confirmButtonText: confirmButton,
                    denyButtonText: denyButton,
                    cancelButtonText: cancelButton
                }).then((result) => { 
                    if(result.isConfirmed){
                        if(confirmEvent != null){
                            Livewire.emit(confirmEvent);
                        }
                    }else if (result.isDenied){
                        if(denyEvent != null){
                            Livewire.emit(denyEvent);
                        }
                    }else if(result.isDismissed){
                        if(result.dismiss == Swal.DismissReason.cancel){
                            if(cancelEvent != null){
                                Livewire.emit(cancelEvent);
                            }
                        }
                    }
                });
            }
            if(toastarr["detail"][0] == "exception"){
                Swal.fire({
                    title: toastTitle == null ? 'Error!' : toastTitle,
                    text: toastarr["detail"][1],
                    icon: "exception",
                    showConfirmButton: confirmButton == null ? false : true
                    showDenyButton: denyButton == null ? false : true
                    showCancelButton: cancelButton == null ? false : true
                    confirmButtonText: confirmButton,
                    denyButtonText: denyButton,
                    cancelButtonText: cancelButton
                }).then((result) => { 
                    if(result.isConfirmed){
                        if(confirmEvent != null){
                            Livewire.emit(confirmEvent);
                        }
                    }else if (result.isDenied){
                        if(denyEvent != null){
                            Livewire.emit(denyEvent);
                        }
                    }else if(result.isDismissed){
                        if(result.dismiss == Swal.DismissReason.cancel){
                            if(cancelEvent != null){
                                Livewire.emit(cancelEvent);
                            }
                        }
                    }
                });
            }
            if(toastarr["detail"][0] == "info"){
                Swal.fire({
                    title: toastTitle == null ? 'Info!' : toastTitle,
                    text: toastarr["detail"][1],
                    icon: "info",
                    showConfirmButton: confirmButton == null ? false : true
                    showDenyButton: denyButton == null ? false : true
                    showCancelButton: cancelButton == null ? false : true
                    confirmButtonText: confirmButton,
                    denyButtonText: denyButton,
                    cancelButtonText: cancelButton
                }).then((result) => { 
                    if(result.isConfirmed){
                        if(confirmEvent != null){
                            Livewire.emit(confirmEvent);
                        }
                    }else if (result.isDenied){
                        if(denyEvent != null){
                            Livewire.emit(denyEvent);
                        }
                    }else if(result.isDismissed){
                        if(result.dismiss == Swal.DismissReason.cancel){
                            if(cancelEvent != null){
                                Livewire.emit(cancelEvent);
                            }
                        }
                    }
                });
            }
            if(toastarr["detail"][0] == "question"){
                Swal.fire({
                    title: toastTitle == null ? 'Question!' : toastTitle,
                    text: toastarr["detail"][1],
                    icon: "question",
                    showConfirmButton: confirmButton == null ? false : true
                    showDenyButton: denyButton == null ? false : true
                    showCancelButton: cancelButton == null ? false : true
                    confirmButtonText: confirmButton,
                    denyButtonText: denyButton,
                    cancelButtonText: cancelButton
                }).then((result) => { 
                    if(result.isConfirmed){
                        if(confirmEvent != null){
                            Livewire.emit(confirmEvent);
                        }
                    }else if (result.isDenied){
                        if(denyEvent != null){
                            Livewire.emit(denyEvent);
                        }
                    }else if(result.isDismissed){
                        if(result.dismiss == Swal.DismissReason.cancel){
                            if(cancelEvent != null){
                                Livewire.emit(cancelEvent);
                            }
                        }
                    }
                });
            }
        });
    @endif
    
    </script>
    <!-- /SWEET ALERT 2 -->

</div>