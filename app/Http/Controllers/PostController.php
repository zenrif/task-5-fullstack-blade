<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('article.index', [
            'posts' => Post::latest()->paginate(5)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|file|max:2048',
            'content' => 'required'
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'post-images/';
            $postImg = date('YmdHis') . auth()->user()->id . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImg);
            $validatedData['image'] = "$postImg";
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['category_id'] = $request->category_id;
        // dd($validatedData);
        Post::create($validatedData);

        return redirect('/article')->with('success', 'Berhasil membuat artikel baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('article.show', [
            'post' => Post::where('id', $id)->with('author', 'category')->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('article.edit', [
            'post' => Post::where('id', $id)->with('category')->first(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'image' => 'image|file|max:2048',
            'content' => 'required'
        ]);

        if ($image = $request->file('image')) {
            if ($request->oldImage) {
                File::delete('post-images/' . $request->oldImage);
            }
            $destinationPath = 'post-images/';
            $postImg = date('YmdHis') . auth()->user()->id . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImg);
            $validatedData['image'] = "$postImg";
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['category_id'] = $request->category_id;

        Post::where('id', $id)
            ->update($validatedData);

        return redirect('/article')->with('success', 'Berhasil mengubah artikel!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        if ($post->image) {
            File::delete('post-images/' . $post->image);
        }

        Post::destroy($post->id);

        return redirect('/article')->with('success', 'Berhasil menghapus artikel!');
    }
}
