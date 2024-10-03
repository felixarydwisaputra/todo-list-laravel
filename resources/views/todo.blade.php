<!DOCTYPE html>
<html lang="en" class="font-display">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Edu+AU+VIC+WA+NT+Guides:wght@400..700&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
    <title>Halaman To-Do List</title>
</head>

<body>
    <header class="p-5 flex items-center justify-between mb-10 px-20">
        <h1 class="text-3xl text-center">To-Do List</h1>
        <div class="flex items-center gap-2">
            <div class="bg-black w-8 h-8 rounded-full flex items-center justify-center text-white">
                {{ !$nama ? 'U' : Str::upper(substr($nama, 0, 1)) }}</div>
            <p>{{ !$nama ? 'username' : Str::replace(' ', '', $nama) }}@user</p>
            |
            <a href="/" class="text-blue-500 transition-colors">Keluar &raquo;</a>
        </div>
    </header>

    <main class="max-w-screen-lg m-auto flex flex-col py-10 ">
        <div class="form-input m-auto">
            <form action="{{ route('todo.store') }}" method="post" class="flex">
                @csrf
                <input type="text" name="todo" size="100" class="border-2 border-black rounded-l-md p-2 px-3"
                    placeholder="Masukkan todo disini..." autocomplete="off" value="{{ old('todo') }}">
                <button type="submit"
                    class="text-white border-2 border-black rounded-r-md p-2 px-3  bg-black hover:bg-gray-800 hover:border-gray-800 transition-all">Tambah
                    Todo</button>
            </form>
        </div>
        <div class="mt-10 mb-5">
            @if (session('berhasil'))
                <p class="text-xl text-center text-green-500">{{ session('berhasil') }}</p>
            @endif
            @if ($errors->any())
                <p class="text-lg text-center italic text-red-500">{{ $errors->first() }}</p>
            @endif
        </div>
        <div class="max-w-screen ">
            @if ($data->count() > 0)
                <div class="rounded-md p-7 max-w-screen-lg">
                    <ul>
                        @foreach ($data as $item)
                            <li x-data="{ isOpen: false }" class="mb-5">
                                <div class="{{ $item->is_done ? 'bg-green-100' : 'bg-gray-100' }} p-3 flex justify-between items-center"
                                    :class="{ 'rounded-t-md': isOpen, 'rounded-md': !isOpen }">
                                    <p class="text-2xl flex-1 {{ $item->is_done ? 'text-gray-400' : 'text-black' }}">
                                        {!! $item->is_done ? '<s>' : '' !!}{{ $item->todo }}
                                        {!! $item->is_done ? '</s>' : '' !!}</p>
                                    <div class="flex-1">
                                        <span class="text-gray-500 text-sm text-light text-left">Dibuat pada
                                            {{ $item->created_at->format('F j, Y, g:i a') }}</span>
                                    </div>
                                    <div class="flex gap-3 flex-1 justify-end">
                                        <button type="button" @click= "isOpen = !isOpen"
                                            class="bg-yellow-400 px-3 py-1 rounded-md"
                                            x-text="isOpen ? 'Tutup' : 'Ubah'"></button>
                                        <form action="{{ route('todo.delete', ['id' => $item->id]) }}" method="post"
                                            onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="bg-red-600 px-3 py-1 rounded-md text-white">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                                <div x-show="isOpen" @click.outside= "isOpen = false"
                                    class="bg-gray-100 p-3 rounded-b-md"
                                    x-transition:enter="transition-all ease-out duration-700">
                                    <form action="{{ route('todo.update', [$item->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="flex items-center justify-between">
                                            <input type="text" name="todo-edit" size="50"
                                                class="p-2 border-2 border-black rounded-md"
                                                value="{{ $item->todo }}" autocomplete="off">
                                            <div class="flex justify-around items-center gap-5 w-full">
                                                <div class="flex items-center gap-2">
                                                    <label for="todo-state">Selesai</label>
                                                    <input type="radio" name="todo-state" class="scale-110"
                                                        value="1" {{ $item->is_done ? 'checked' : '' }}>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <label for="todo-state">Belum Selesai</label>
                                                    <input type="radio" name="todo-state" class="scale-110"
                                                        value="0" {{ $item->is_done ? '' : 'checked' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-green-600 hover:bg-green-700 p-2 mt-5 rounded-md text-white">Simpan
                                            Perubahan</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-center text-5xl my-14 text-gray-600">Belum ada data todo yang dibuat.</p>
            @endif
        </div>
    </main>

</body>

</html>
