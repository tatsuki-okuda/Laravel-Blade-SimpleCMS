<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    /*
    // タグの読み込み処理を共通にする
    public function __construct()
    {
        $this->middleware(function ($request, \Closure $next) {
            \View::share('tags', Tag::pluck('name', 'id')->toArray());
            return $next($request);
        })->only('create', 'edit');
    }
    */


    /**
     * 一覧画面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // $posts = Post::latest('id')->paginate(20);
        // Eager Loadingを使うことでクエリの数がヘル
        $posts = Post::with('user')->latest('id')->paginate(20);
        return view('back.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 投稿でタグモデルを保存できるようにタグの一覧を取得する。
        $tags = Tag::pluck('name', 'id')->toArray();
        return view('back.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        // タグを追加
        $post->tags()->attach($request->tags);

 
        if ($post) {
            return redirect()
                ->route('back.posts.edit', $post)
                ->withSuccess('データを登録しました。');
        } else {
            return redirect()
                ->route('back.posts.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post;  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::pluck('name', 'id')->toArray();
        return view('back.posts.edit', compact('post', 'tags'));
        // return view('back.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post;  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // タグを更新
        $post->tags()->sync($request->tags);

        if ($post->update($request->all())) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }
     
        return redirect()
            ->route('back.posts.edit', $post)
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post;  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        // タグを削除
        $post->tags()->detach();

        if ($post->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }
     
        return redirect()
            ->route('back.posts.index')
            ->with($flash);
    }
}
