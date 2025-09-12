@if ($errors->any())
    <script>
        window.onload = function() {
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            } else {
                console.error('Toastr is not loaded. Please check your script includes.');
            }
        };
    </script>
@endif

@if (session('success'))
    <script>
        window.onload = function() {
            if (typeof toastr !== 'undefined') {
                toastr.success('{{ session('success') }}');
            } else {
                console.error('Toastr is not loaded. Please check your script includes.');
            }
        };
    </script>
@endif
