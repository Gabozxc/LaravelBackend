<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Global CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">
    @yield('content')
</body>

<!-- Global JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.js"
    integrity="sha512-ZHzbWDQKpcZxIT9l5KhcnwQTidZFzwK/c7gpUUsFvGjEsxPusdUCyFxjjpc7e/Wj7vLhfMujNx7COwOmzbn+2w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>
