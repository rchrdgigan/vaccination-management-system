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
                $('.modal-body #vacc_id').val(vaccine_id);
                $('.modal-body #child_id').val(child_id);
              });
        </script>
        <script>
            $(document).on("click", ".del-dialog", function () {
                var child_id = $(this).data('child_id');
                $('.modal-body #child_id').val(child_id);
              });
        </script>
    </body>

</html>
