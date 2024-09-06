<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Pagination\Paginator;

class BlogController extends Controller
{

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', ['post' => $post]);
    }

    public function store(CreatePostRequest $request)
    {
        /*  $post = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'slug' => Str::slug($request->input('title'))
        ]); */
        $post = Post::create($request->validated());

        //dd($request->all());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été sauvegardé");
    }

    public function edit(Post $post)
    {
        return view('blog.edit', ['post' => $post]);
    }

    public function update(Post $post, CreatePostRequest $request)
    {
        $post->update($request->validated());

        //dd($request->all());

        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");
    }

    /*  public function delete(Post $post)
    {
        $post->delete();

        return redirect()->route('blog.index'); //->with('success', "L'article a bien été modifié");
    } */

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
