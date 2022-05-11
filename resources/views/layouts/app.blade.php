<!DOCTYPE html>

<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="images/vaccine_logo.png" rel="shortcut icon">

        <title>@yield('title')</title>
        @stack('links')
        @livewireStyles
        <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" />
    </head>
    <!-- END: Head -->
    <body class="app">
        <!-- BEGIN: Mobile Menu -->
        @include('layouts.partials.mobile-nav')
        <div class="flex">
           @include('layouts.partials.side-nav')
            <div class="content">
                @include('layouts.partials.top-bar')
                @yield('content')
            </div>
        </div>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>
        <script src="{{asset('js/validation.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        @livewireScripts
        @stack('scripts')
        <script>
            window.addEventListener('swal:confirm', event => {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: event.detail.message,
                showCancelButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `Cancel`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('delete', event.detail.id)
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Successfully Deleted',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            });
        });
        </script>
        <script>
            $(document).on("click", ".open-dialog", function () {
                var child_id = $(this).data('child_id');
                var vaccine_id = $(this).data('vaccine_id');
                var vaccine_name = $(this).data('vaccine_name');
                var vaccine_dose = $(this).data('vaccine_dose');
                var vaccine_description = $(this).data('vaccine_description');
                var dose = $(this).data('dose');
                $('.modal-body #dose').val(dose);
                $('.modal-body #vacc_dose').val(vaccine_name + " - " + dose);
                $('.modal-body #description').val(vaccine_description);
                $('.modal-body #vaccine_id').val(vaccine_id);
              });
        </script>
         <script>
            $(document).on("click", ".edit-dialog", function () {
                var id = $(this).data('id');
                var vaccine_id = $(this).data('vaccine_id');
                var vaccine_name = $(this).data('vaccine_name');
                var vaccine_dose = $(this).data('vaccine_dose');
                var vaccine_description = $(this).data('vaccine_description');
                var dose = $(this).data('dose');
                var remarks = $(this).data('remarks');
                var status = $(this).data('status');
                var date = $(this).data('date');
                var inj = $(this).data('inj');
                if(inj == 1){
                    document.getElementById("has_inj").checked = true;
                }else{
                    document.getElementById("has_inj").checked = false;
                }
                document.getElementById("status").value = status;
                $('.modal-body #id').val(id);
                $('.modal-body #dose').val(dose);
                $('.modal-body #vacc_dose').val(vaccine_name + " - " + dose);
                $('.modal-body #description').val(vaccine_description);
                $('.modal-body #remarks').val(remarks);
                $('.modal-body #date').val(date);
                $('.modal-body #vaccine_id').val(vaccine_id);
              });
        </script>
    </body>

</html>
