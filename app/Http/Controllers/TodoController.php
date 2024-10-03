<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $reqAwal)
    {
        // $reqAwal->validate([
        //     'username' => 'required|min:3|max:25',
        // ]);
        $nama = $reqAwal->input('username');
        $data = Todo::get();
        return view('todo', ['data' => $data, 'nama' => $nama]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|min:3|max:25',
        ], [
            'todo.required' => 'Data todo wajib diisi.',
            'todo.min' => 'Data todo minimal 3 karakter.',
            'todo.max' => 'Data todo maksimal 25 karakter.',
        ]);

        $data = [
            'todo' => $request->input('todo'),
        ];

        Todo::create($data);
        return redirect()->route('todo.index')->with('berhasil', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'todo-edit' => 'required|min:3|max:25',
        ], [
            'todo-edit.required' => 'Data todo wajib diisi.',
            'todo-edit.min' => 'Data todo minimal 3 karakter.',
            'todo-edit.max' => 'Data todo maksimal 25 karakter.',
        ]);

        $data = [
            'todo' => $request->input('todo-edit'),
            'is_done' => $request->input('todo-state'),
        ];

        Todo::where('id', $id)->update($data);
        return redirect('/todo')->with('berhasil', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();
        return redirect()->route('todo.index')->with('berhasil', 'Data berhasil dihapus.');
    }
}
