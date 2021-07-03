<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
$title = '投稿一覧';
?>
@extends('front.layouts.base')
 
@section('content')
<div class="card-header">{{ $title }}</div>
<div class="card-body">
    @if($posts->count() <= 0)
        <p>表示する投稿はありません。</p>
    @else
        <table class="table">
            @foreach($posts as $post)
                <tr>
                    {{-- モデルのゲッターでフォーマットを指定できる。 --}}
                    {{-- <td>{{ $post->published_at->format('Y年m月d日') }}</td> --}}
                    <td>{{ $post->published_format }}</td>
                    <td>{!! link_to_route('front.posts.show', $post->title, $post) !!}</td>
                </tr>
            @endforeach
        </table>
        {{-- ページネーション --}}
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection