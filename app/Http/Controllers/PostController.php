<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use App\Tag;

class PostController extends Controller
{
    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = \App\Post::visible()->latest('updated_at')->limit(100)->paginate(5);
        $postscount = \App\Post::visible()->count();
        $title = 'Beiträge';

        return view('post.posts', compact('posts', 'postscount', 'title'));
    }

    /**
     * Display a listing of the Posts with given tag / tag_id.
     *
     * @return \Illuminate\Http\Response
     */
    public function withTag(Tag $tag)
    {
        $posts = $tag->visiblePosts()->latest('updated_at')->paginate(5);
        $postscount = $tag->visiblePosts()->count();
        $title = 'Beiträge mit dem Tag: '.$tag->name;

        return view('post.posts', compact('posts', 'postscount', 'title'));
    }

    /**
     * Display a listing of the Posts with given tag / tag_id.
     *
     * @return \Illuminate\Http\Response
     */
    public function gettag(Request $request)
    {
        $posts = \App\Tag::find($request->tag)->visiblePosts()->latest('updated_at')->paginate(5);
        $postscount = \App\Tag::find($request->tag)->visiblePosts()->count();
        $title = 'Beiträge mit dem Tag: '.\App\Tag::find($request->tag)->name;

        return view('post.posts', compact('posts', 'postscount', 'title'));
    }

    /**
     * Display a listing of the unpublished posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function unpublished()
    {
        $posts = \App\Post::unpublished()->latest('updated_at')->paginate(5);
        $postscount = \App\Post::unpublished()->count();
        $title = 'Entwürfe';

        return view('post.posts', compact('posts', 'postscount', 'title'));
    }

    /**
     * Display a listing of the posts tobepublished.
     *
     * @return \Illuminate\Http\Response
     */
    public function tobepublished()
    {
        $posts = \App\Post::tobepublished()->latest('updated_at')->paginate(5, ['*'], 'unpubPosts');
        $postscount = \App\Post::tobepublished()->count();
        $title = 'Noch freizugebende Beiträge';

        return view('post.posts', compact('posts', 'postscount', 'title'));
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
     * search all posts for given text
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $posts = Post::where('status_id', 4)
                        ->Where(function ($query) use ($request) {
                            $query->where('title', 'like', '%' . $request->search . '%')
                                  ->orwhere('content', 'like', '%' . $request->search . '%');
                        })
                       ->paginate(5);
        $postscount = count($posts);
        $title = 'Ihre Suche nach ' . $request->search . ' ergab folgende Resultate';

        return view('post.posts', compact('posts', 'postscount', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Auth::User()->posts()->create([
            'title' =>$request->title,
            'content' => $request->content,
            'section_id' => Auth::User()->section_id,
            'public' => ($request->has('public') ? 1 : 0),
            'status_id' => $request->status_id,
        ]);

        //return redirect()->action('PostController@unpublished');
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    { //dd(\Auth::User()->can('publish'));
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $tags = $request->tags;
        foreach ($tags as $key => $tag) {
            if(!ctype_digit($tag)){
                $newTag = \App\Tag::create([
                    'name' => $tag,
                ]);
                unset($tags[$key]);
                $tags[] = $newTag->id;
            }
        }
        // $post->syncTags($tags);
        $post->tags()->sync($tags);

        $post->update([
            'title' => $request->title,
            'content' =>$request->content,
            'public' => isset($request->public) ? 1 : 0,
            'status_id' => $request->status_id,
        ]);

        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    /**
     * Reset the post to draft (status_id =1, not published).
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function reset(Post $post)
    {
        $post->status_id = 1;
        $post->save();

        return redirect()->route('post.edit', ['id' => $post->id]);
    }
}
