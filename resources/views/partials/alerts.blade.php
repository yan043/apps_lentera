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
