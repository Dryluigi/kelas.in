<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Post\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);
        $posts = $kelas->posts()->with(['user', 'user.user'])->latest()->get();
        $data['posts'] = $posts;

        // dd($data);

        return view('posts.index')->with($data);
    }

    public function create(Kelas $kelas)
    {
        $data = $this->getTemplateData($kelas);

        return view('posts.create')->with($data);
    }

    public function store(Kelas $kelas, Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
        ]);

        auth()->user()->posts()->create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'class_id' => $kelas->id,
            'post_type_id' => env('POST_UMUM_ID', '0'),
        ]);

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Post berhasil dibuat';

        return redirect()->route('classes.posts', $kelas)->with($data);
    }

    public function show(Kelas $kelas, Post $post)
    {
        $data = $this->getTemplateData($kelas);
        $data['post'] = $post;

        return view('posts.show')->with($data);
        // dd('show post');
    }

    public function edit(Kelas $kelas, Post $post)
    {
        $this->authorize('edit', $post);
        
        $data = $this->getTemplateData($kelas);
        $data['post'] = $post;

        return view('posts.edit')->with($data);
    }

    public function update(Kelas $kelas, Post $post, Request $request)
    {
        $this->authorize('update', $post);
        
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
        ]);

        $post->update($request->only('judul', 'isi'));

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Post berhasil diupdate';

        return redirect()->route('classes.posts', [$data['class'], $data['user']])
            ->with($data);
    }

    public function destroy(Kelas $kelas, Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        $data = $this->getTemplateData($kelas);
        $data['success'] = 'Post berhasil dihapus';

        return back()->with($data);
    }

    private function getTemplateData(Kelas $kelas)
    {
        $user = auth()->user();

        return [
            'user' => $user,
            'class' => $kelas,
            'role' => $kelas->getUserRole($user),
        ];
    }
}
