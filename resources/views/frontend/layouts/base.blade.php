<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('frontend.layouts.partials.header')
    <title>Document</title>
</head>
<body>
    @yield('content')

    <script src="{{ asset('lib/js/snackbar.min.js') }}"></script>
    <script>

        $(document).ready(function () {
            @if (session('success'))
                Snackbar.show({
                    pos: 'bottom-left',
                    textColor: '#f8f9fa',
                    actionTextColor: '#f8f9fa',
                    backgroundColor: '#28a745',
                    text: '{{ session('success') }}',
                    actionText: '{{ __('Dismiss') }}',
                });
            @endif

            @if (session('fail'))
                Snackbar.show({
                    pos: 'bottom-left',
                    textColor: '#f8f9fa',
                    actionTextColor: '#f8f9fa',
                    backgroundColor: '#dc3545',
                    text: '{{ session('fail') }}',
                    actionText: '{{ __('Dismiss') }}',
                });
            @endif
        })

    </script>
</body>
</html>
