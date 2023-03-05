@extends('layouts.app')

@section('content')


            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$title}} ({{$postscount}})</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach ($posts as $key => $post)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-9" style="margin-top: 10px; margin-bottom:10px;">
                                        <h3 style="margin-top:0px;">
                                            {{$post->title}}
                                        </h3>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 10px; margin-bottom:10px;">
                                        <div class="btn-group pull-right">
                                            @can('isVisible', $post)
                                                @can('edit', $post)
                                                    <a href= {{ action('PostController@reset', ['id' => $post->id]) }} class="btn btn-sm btn-danger" >Zurücksetzen</a>
                                                @endcan
                                            @else
                                                <a href= {{ action('PostController@edit', ['id' => $post->id]) }} class="btn btn-sm btn-warning" >Bearbeiten</a>
                                            @endcan
                                            <a href= {{ action('CommentController@create', ['post' => $post->id]) }} class="btn btn-sm btn-success" >Kommentar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-12">
                                          {!! $post->content !!}
                                        </div>
                                        <div class="col-md-12">
                                          <hr>
                                        </div>
                                        <div class="col-md-6">
                                            <strong >Autor: {{$post->user->firstname}} {{$post->user->lastname}}, {{$post->section->name}}</strong>
                                        </div>
                                        <div class="col-md-6">
                                            Zuletzt bearbeitet: {{$post->updated_at->format('d.m.Y')}}
                                        </div>
                                        <div class="col-md-6">
                                            Sichtbar: {{($post->public) ? "öffentlich" : "nur im eigenen Bereich"}}
                                        </div>
                                        <div class="col-md-6">
                                            Status: {{$post->status->name}}
                                        </div>
                                        <div class="col-md-6">
                                          @if($post->comments->count()>0)
                                            {{link_to_action('PostController@show', "Post mit Kommentaren ansehen", array('id' => $post->id), null)}}
                                          @endif
                                        </div>
                                        <div class="col-md-6">
                                            <span style="float:left; padding-top:16px; margin-right:10px">
                                                Tags:
                                            </span>
                                            <ul class="tagList">
                                                @foreach ($post->tags as $key => $tag)
                                                        <li class="tags_rendered">
                                                            {{$tag->name}}
                                                        </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">ha
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>


@endsection
