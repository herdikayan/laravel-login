<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Post';
        $data['q'] = $request->q;
        $data['rows'] = Post::where('post_title', 'like', '%' . $request->q . '%')->get();
        return view('post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['title'] = 'Tambah Post';
        $data['categories'] = ['Politik', 'Kesehatan', 'Olahraga'];
        return view('post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'category' => 'required',
        ]);

        $post = new Post();
        $post->post_title = $request->post_title;
        $post->category = $request->category;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/post', $name);
            $post->image = $name;
        }
        $post->content = $request->content;
        $post->save();
        return redirect('post')->with('success', 'Tambah Data Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data['title'] = 'Ubah Post';
        $data['row'] = $post;
        $data['categories'] = ['Politik', 'Kesehatan', 'Olahraga'];
        return view('post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'post_title' => 'required',
            'category' => 'required',
        ]);

        $post->post_title = $request->post_title;
        $post->category = $request->category;
        if ($request->hasFile('image')) {
            $post->delete_image();
            $image = $request->file('image');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/post', $name);
            $post->image = $name;
        }
        $post->content = $request->content;
        $post->save();
        return redirect('post')->with('success', 'Ubah Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete_image();
        $post->delete();
        return redirect('post')->with('success', 'Hapus Data Berhasil');
    }
}
