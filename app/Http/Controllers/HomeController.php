<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::all();
        $posts = Post::paginate(15);
        $posts->load('user');
        // dd($posts);
        return view('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if($request->file('image')->isValid()) {
            $id = Auth::id();
            $post = new Post;
            
            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = $id;

            $filename = $request->file('image')->store('public/image');
            $post->image = basename($filename);
        }

        \DB::beginTransaction();

        try {
            //code...
            //登録
            $post->save();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            abort(500);
        }
        // dd($post);
        \Session::flash('err_msg', 'あなたの投稿を登録しました。');
        // dd($post);
        return redirect()->route('home');

    }

    /**
     * 詳細一覧
     * @param int $id
     * @return view
     */
    public function detail($id)
    {
        $post = Post::find($id);
        $post->load('user');
        // dd($post);
        
        if (is_null($post)) {
            \Session::flash('err_msg', 'データがないよ');
            return redirect(route('home'));
        }

        return view('post.detail', ['post' => $post]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc');
        // dd($posts);

        if (is_null($posts)) {
            \Session::flash('err_msg', 'データがないよ');
            return redirect(route('home'));
        }

        return view('post.user', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postdelete($id)
    {
        if (empty($id)) {
            \Session::flash('err_msg', 'データがないよ');
            return redirect(route('home'));
        }

        $post = Post::find($id);

        // dd($post);
        try {
            //code...
            $post->delete($id);
        } catch (\Throwable $th) {
            //throw $th;
            abort(500);
        }

        \Session::flash('err_msg', '削除ができました');
        return redirect()->route('home');
    }

    public function search(SearchRequest $request) {
        // dd($request->search);
        $posts = Post::where('title', 'like','%'.$request->search.'%')->orWhere('content','like', '%'.$request->search.'%')->paginate(10);

        $search_result = $request->search.'の検索結果'.$posts->total().'件';

        // dd($search_result);
        return view('home', ['posts' => $posts, 'search_result' => $search_result, 'search_query'  => $request->search]);
    }
}
