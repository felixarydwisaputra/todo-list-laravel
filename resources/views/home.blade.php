<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Guides:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Halaman Home</title>
</head>

<body class="font-display">
    <main class="text-center min-h-screen flex flex-col items-center justify-center gap-7 bg-gray-200">
        <h1 class="text-7xl">Selamat Datang, di <span class="text-green-500">To-Do List</span> Anda.</h1>
        <form action="{{ route('todo.index') }}" method="get" class="my-5">
            @csrf
            <input type="text" name="username" size="100"
                class="{{ $errors->any() ? 'placeholder:text-red-500' : '' }} border-2 border-black rounded-md p-2 px-3"
                placeholder="{{ $errors->any() ? 'Username tidak boleh kosong!!! Biar seru aja 😁' : 'Masukkan username disini...' }}"
                autocomplete="off" value="{{ old('todo') }}">
            <button type="submit"
                class="text-white py-2 px-5 border-2 border-black rounded-md bg-black transition-all">Lanjut
                &raquo;</button>
        </form>
        <p class="text-gray-400 transition-colors text-md mt-10">Dibuat oleh @felixarydwisaputra pada 2024.</p>
    </main>
</body>

</html>
