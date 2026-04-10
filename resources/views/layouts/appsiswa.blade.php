<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="font-sans antialiased bg-white  ">
    

    <div class="min-h-screen flex">
        {{-- SideBar --}}
        @include('components.sidebarsiswa')

        <div class="flex-1 flex-col">

            <main class="flex-1 p-6">
                @yield('content')
            </main>

            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>