<?php
// codingan ini ketika tidak menggunakan mahasiswaController.php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Tampilkan semua post (bisa diakses semua user).
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Tampilkan detail post (bisa diakses semua user).
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    //  ==== Admin ====
    // Form tambah post (hanya admin).
    public function create()
    {
        $this->authorizeAdmin();
        return view('posts.create');
    }

    
    // Simpan post baru (hanya admin).
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat');
    }

    // Form edit post (hanya admin).
    public function edit(Post $post)
    {
        $this->authorizeAdmin();
        return view('posts.edit', compact('post'));
    }

    
    // Update post (hanya admin). 
    public function update(Request $request, Post $post)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupdate');
    }

    
    // Hapus post (hanya admin). 
    public function destroy(Post $post)
    {
        $this->authorizeAdmin();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus');
    }

    
    // Helper untuk cek role admin.
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }
}

