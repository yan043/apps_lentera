<link rel="stylesheet" href="/assets/extensions/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" crossorigin href="/assets/compiled/css/extra-component-sweetalert.css">
<script src="/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script src="/assets/static/js/pages/sweetalert2.js"></script>
@if ($errors->any())
    <script>
        window.onload = function () {
            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: '{{ $error }}'
                });
            @endforeach
        };
    </script>
@endif
