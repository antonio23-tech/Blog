<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id');
        $tags=Tag::all();
        return view('admin.posts.create',compact('categories','tags'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // se inserta informacion de los botones a la tabla posts excepto tags
        $post=Post::create($request->all());

        // validar si se estan enviando una imagen
        if($request->file('file')){
            $url=Storage::put('posts', $request->file('file'));

            // se inserta la imagen
            $post->image()->create([
                 'url'=>$url
            ]);
        }

        // validar las etiquetas
        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        return redirect()->route('admin.posts.edit',$post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('author',$post);

        $categories=Category::pluck('name','id');
        $tags=Tag::all();
        return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        //se realiza regla de validacion en un policy
        $this->authorize('author',$post);

        // se actualiza el post
        $post->update($request->all());

        // se guarda imagen
        if ($request->file('file')) {
           $url= Storage::put('posts',$request->file('file'));

           // se borra la imagen si es que existe una relacion con el post
        if ($post->image) {
            Storage::delete($post->image->url);

            // se actualiza la imagen
            $post->image->update([
                'url'=>$url
            ]);

        }else{
            $post->image()->create([
                'url'=>$url
            ]);
        }
        
        }

         // validar las etiquetas
         if($request->tags){
            $post->tags()->sync($request->tags);
        }
        return redirect()->route('admin.posts.edit',$post)->with('info','El post se actualizo correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author',$post);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info','El post ha sido eliminado correctamente');
    }
}
