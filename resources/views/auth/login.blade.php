<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <div class="flex flex-col justify-center items-center min-h-screen p-4">
        <div class="w-full max-w-sm mb-4 text-center flex justify-end">
            <a href="{{ route('login.siswa') }}" class="inline-flex items-center gap-2 text-end ">
                <svg class="w-6 h-6 text-black " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                </svg>
                Kembali 
            </a>
        </div>
        <div class="grid grid-cols-1 rounded-md  w-100 h-80 bg-gray-300">
            <div class="flex-col p-8 justify-center">
                <form action="{{route('login.admin')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h1 class="text-center mb-3 text-2xl font-semibold text-black">Login Admin</h1>
                    <div class="mb-3 relative">
                        <svg class="w-6 h-6 text-gray-800 absolute left-4 top-1/2 -translate-y-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                        </svg>
                        <input type="text" name="username" class="form-control mb-3 w-full pl-10 pr-3 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring focus:ring-black " placeholder="Masukan Username/Nisn">
                    </div>
                    <div class="mb-3 relative">
                        <svg class="w-6 h-6 text-gray-800  absolute left-4.5 top-1/2 -translate-y-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                        </svg>
                        <input type="password" name="password" class="form-control mb-3 w-full pl-10 pr- py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring focus:ring-black " placeholder="Masukan Password" aria-label="password">
                    </div>
                    
                    <button type="submit" class="bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-300 w-full transition duration-200 text-center">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>