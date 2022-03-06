<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            // ambil data semua postingan berdasarkan akun yg sedang login
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validasi data field dalam form
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        //cek jika tidak ada gambar yang dimasukkan, maka gunakan gambar default api unsplash
        if($request->file('image'))
        {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        
        // tentukan user_id dan tambahkan excerptnya
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] =  Str::limit(strip_tags($request->body), 200);

        // simpan ke database
        Post::create($validatedData);

        // arahkan ke halaman dashboard/posts serta kirimkan validasi sukses
        return redirect('/dashboard/posts')->with('success', 'New post has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
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
         $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        // validasi slug
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // validasi jika tidak ada gambar yang dimasukkan, maka gunakan gambar default api unsplash
        if($request->file('image'))
        {
        //    jika ada gambar lama
            if($request->oldImage)
            {
                // hapus gambar lama
                Storage::delete($request->oldImage);
            }

            // upload gambar baru
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] =  Str::limit(strip_tags($request->body), 200);

        // update data berdasarkan id
        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // jika ada gambar lama
        if($post->image){
            // hapus gambar lama
            Storage::delete($post->image);
        }

         // simpan ke database
        Post::destroy($post->id);

        // arahkan ke halaman dashboard/posts serta kirimkan validasi sukses
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
