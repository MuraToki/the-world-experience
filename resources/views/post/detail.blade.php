@extends('layouts.app')
@section('title', 'ユーザーの詳細｜')
@section('content')

<div class="p-2">
    <div class="content p-3 my-3 rounded">
        <div class="flex-main">
            <div class="de-first-main">
                <div class="detail-name">
                    <p class="text-center">
                        <span class="span-name fs-4 fw-bold">{{ $post->user->name }}</span>
                    </p>
                </div>

                <div class="detail-title my-3">
                    <h5 class="text-center fs-3">『<span class="fw-bold">{{ $post->title }}</span>』</h5>
                </div>

                <div class="passege my-2">
                    <p class="card-text text-start fs-5" style="white-space: pre-wrap;">{{ $post->content }}</p>
                </div>

                <div class="good_count text-center">
                    @if($post->users()->where('user_id', Auth::id())->exists())
                    <div class="my-3">
                        <form action="{{ route('unfavorites', $post) }}" method="POST" onSubmit="return unlikeDlete()">
                        @csrf
                            <button type="submit" class="btn btn-danger rounded-pill"><i class="fa-solid fa-heart"></i>・{{ $post->users()->count() }}</button>
                        </form> 
                    </div>
                    @else
                    <div class="my-3">
                        <form action="{{ route('favorites', $post) }}" method="POST" onSubmit="return likeSubmit()">
                        @csrf
                            <button type="submit" class="btn btn-primary rounded-pill"><i class="fa-solid fa-heart"></i>・{{ $post->users()->count() }}</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <div class="de-second-main">
                <div class="image text-center">
                    <img src="{{ asset('storage/image/'.$post->image) }}" style="height: 220px; width: 313px;" class="rounded">
                </div>
                <div class="text-dark text-center fw-bold mt-2">
                        {{ $post->created_at }}
                </div>  
            </div>
        </div>

        <!-- button -->
        <div class="justify-content-center mt-2" style="display: flex;" id="all-exit">
            <a class="btn btn-secondary" href="{{ route('home') }}"><i class="fa-solid fa-arrow-left-long"></i></a>
            <a href="{{ route('show', $post->user_id)}}" class="btn btn-dark ms-3"><i class="fa-solid fa-user"></i></a>
            <a href="{{ route('comment.create', ['post_id' => $post->id])}}" class="btn btn-warning ms-3"><i class="fa-solid fa-comments"></i></a>

            @if(Auth::user()->id == $post->user_id)
            <form method="POST" action="{{ route('post.delete', $post->id)}}" onSubmit="return experienceDlete()">
                @csrf
                <button type="submit" class="btn btn-danger ms-3" onclick=><i class="fas fa-trash-alt"></i></button>
            </form>
            @endif
        </div>
    </div>
</div>



<header class="comment_list my-4">
    <div class="comment">
        <h1 class="text-center fw-bold text-light"><span id="span_comment" class="bg-dark bg-gradient p-2 rounded">~List of Comments~</span></h1>
    </div>
</header>

<!-- Error & Search Message -->
<div class="message m-auto">
@if (session('err_msg_update'))
    <div class="err_style col-md-4 my-3 m-auto fw-bold fs-4 rounded">
        <p class="text-success">
            {{ session('err_msg_update') }}
        </p>
    </div>
@endif

@if (session('err_msg_comment'))
    <div class="err_style col-md-4 pt-1 rounded">
        <p class="text-success fs-5 fw-bold">
            {{ session('err_msg_comment') }}
        </p>
    </div>
@endif

@if (session('err_msg'))
    <div class="err_style col-md-4 pt-1 rounded">
        <p class="text-success fs-5 fw-bold">
            {{ session('err_msg') }}
        </p>
    </div>
@endif
</div>


<!-- Comment -->
<div class="comment-all ">
@foreach ($post->comment as $comment)
<div class="comment-list my-4 p-2 rounded">
    <div class="comment-main bg-gradient p-1">
        <p class="comment-name">
            <a href="{{ route('show', $comment->user->id) }}">
                <span class="home_title fs-5 fw-bold text-black">{{ $comment->user->name }}</span>
            </a>
        </p>
        <div class="comment-content">
            <p class="text-start" style="white-space: pre-wrap;">{{$comment->comment}}</p>
        </div>
    </div>

    <div class="all-sub-comment">
        <div class="com-time">
            <p class="comment-time">{{$comment->created_at}}</p>
        </div>
        
        <div class="all-com-exit">
            @if(Auth::user()->id == $comment->user_id)
            <form method="POST" action="{{ route('delete', $comment->id)}}" onSubmit="return commentDlete()">
                @csrf
                <button type="submit" class="btn btn-danger me-3" onclick=><i class="fas fa-trash-alt"></i></button>
            </form>
            @endif
            
            @if(Auth::user()->id == $comment->user_id)
            <div class="edit">
                <a href="{{ route('edit', $comment->id) }}" class="btn btn-info" id="edit"><i class="fa-solid fa-pen-to-square"></i></a> 
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach
</div>

<script>
function experienceDlete(){
    if(confirm('あなたの体験を削除してもいいかな？')){
        return true;
    } else {
        return false;
        }
    }
function commentDlete(){
    if(confirm('コメントを削除してもいいかな？')){
        return true;
    } else {
        return false;
        }
    }

    function likeSubmit(){
        if(confirm('いいねを押す覚悟はあるか？')){
            return true;
        } else {
            return false;
            }
        }
    function unlikeDlete(){
        if(confirm('いいねを取り消す覚悟はあるか？')){
            return true;
        } else {
            return false;
            }
        } 

</script>
@endsection