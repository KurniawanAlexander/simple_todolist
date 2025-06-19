<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !method_exists($user, 'todos')) {
            return redirect()->route('login')->with('error', 'User tidak valid atau belum login.');
        }

        $todos = $user->todos()->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if (!$user || !method_exists($user, 'todos')) {
            return back()->with('error', 'Gagal menambahkan. User tidak valid.');
        }

        try {
            $user->todos()->create([
                'title' => $request->title,
                'completed' => false,
            ]);

            return redirect()->route('dashboard')->with('success', 'Todo berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan todo. Silakan coba lagi.');
        }
    }

    public function update(Request $request, Todo $todo)
    {
        if ($todo->user_id !== Auth::user()->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $todo->completed = !$todo->completed;
        $todo->save();

        return redirect()->route('dashboard')->with('success', 'Todo berhasil diperbarui!');
    }

    public function destroy(Todo $todo)
    {
        if ($todo->user_id !== Auth::user()->id) {
            abort(403, 'AKSES DITOLAK');
        }

        $todo->delete();

        return redirect()->route('dashboard')->with('success', 'Todo berhasil dihapus!');
    }
}
