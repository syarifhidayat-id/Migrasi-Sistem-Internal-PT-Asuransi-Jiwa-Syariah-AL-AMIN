<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Re-page</title>
</head>
<body>
    <script src="{{ asset('css.admin/dist/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('css.admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('css.admin/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('css.admin/dist/js/jquery-config.min.js') }}"></script>
    <script>
        rePage('{{ route("error") }}');
    </script>
</body>
</html>
