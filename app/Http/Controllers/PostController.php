<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' : ' . $category->name;
        }

        $title = '';
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' : ' . $author->name;
        }


        return view('posts', [
        'title' => 'All Posts' . $title,
        // 'posts' => Post::all(),
        //menampilkan postingan terbaru
        'active' => 'posts',
        'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
 ]);
    }

    public function show(Post $post)
    {
        return view('post', [
        'title' => 'Single Post',
        'post' => $post
    ]);
    }
}
