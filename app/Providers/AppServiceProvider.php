<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Gate;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        view()->composer('layouts/app', function($view){
            if(Auth::check()){
                $unpublishedcount = \App\Post::unpublished()->count();
                $tobepublishedcount = \App\Post::tobepublished()->count();
                $tagscloud = \App\Tag::join('post_tag', 'post_tag.tag_id', '=', 'tags.id')
                ->groupBy('tags.id')
                ->get(['tags.id', 'tags.name', DB::raw('count(tags.id) as tag_count')])
                ->sortByDesc('tag_count')
                ->take(10)
                ->sortBy('name', SORT_NATURAL|SORT_FLAG_CASE);
                $tags_count = \App\Tag::join('post_tag', 'post_tag.tag_id', '=', 'tags.id')->count();
                $tag_list = \App\Tag::all()->sortBy('name')->pluck('name', 'id');

                $view->with('unpublishedcount', $unpublishedcount)
                ->with('tobepublishedcount', $tobepublishedcount)
                ->with('tags_count', $tags_count)
                ->with('tagscloud', $tagscloud)
                ->with('tag_list', $tag_list);
            }
        });

        view()->composer('partials/postform', function($view){
            //if (Auth::User()->role_id < 3) {
            if (Gate::allows('publish-post')) {
                $statuslist = \App\Status::all()->pluck('name', 'id');
            }
            else {
                $statuslist = \App\Status::all()->where('id', '<', 4)->pluck('name', 'id');
            }

            $tagList = \App\Tag::all()->sortBy('name')->pluck('name', 'id');

            $view->with('statuslist', $statuslist)
            ->with('tagList', $tagList);
        });
    }

    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        //
    }
}
