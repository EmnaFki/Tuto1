<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function create(): View
    {
        return view('blog.create');
    }
    public function index(): View
    {
        // c'était pour tester la validation sans passer par l'objet request personnalisé
        /*  $validator = Validator::make([
            'title' => '',
            'content' => 'zzzzzz'
        ]);

        dd($validator->validated()); */

        $posts = Post::paginate(1);
        //dd($posts);
        //return $posts;
        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse| View
    {
        //$post = Post::findOrFail($post);
        /*   return [
              "slug"=> $slug,
              "id" => $id
          ]; */

        //vérifier si le "slug" dans la BD correspond au slug que j'ai reçu
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('blog.show', ['post' => $post]);
    }
}
