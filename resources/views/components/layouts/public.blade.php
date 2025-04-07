<!DOCTYPE html>
<html lang="">

<head>
    @include('components.layouts.app.head')
</head>

<body class="bg-gray-100 h-screen">
    <x:layouts.public.header/>
    {{ $slot }}
</body>

<script>
    // Remove o Dark Mode
    document.documentElement.classList.remove('dark')
</script>

</html>