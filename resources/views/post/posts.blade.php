@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$title}} ({{$postscount}})
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach ($posts as $key => $post)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8" style="margin-top: 30px; margin-bottom:10px;">
                                <h3 style="margin-top:0px;">
                                    {{$post->title}}
                                </h3>
                            </div>
                            <div class="col-md-4" style="margin-top: 30px; margin-bottom:10px;">
                                <div class="btn-group pull-right">
                                    @can('isVisible', $post)
                                        @can('edit', $post)
                                            <a href= {{ action('PostController@reset', ['id' => $post->id]) }} class="btn btn-sm btn-danger" >Zurücksetzen</a>
                                        @endcan
                                    @else
                                        <a href= {{ action('PostController@edit', ['id' => $post->id]) }} class="btn btn-sm btn-warning" >Bearbeiten</a>
                                    @endcan
                                    <a href= {{ action('CommentController@create', ['post' => $post->id]) }} class="btn btn-sm btn-success" >Kommentar</a>
                                    <a href= {{ action('PdfController@post', ['post' => $post->id]) }} class="btn btn-sm btn-default" ><span class="glyphicon glyphicon-print"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="well">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $post->content !!}
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Gültigekeitsbereich: {{$post->section->name}}</strong>
                                    <p><strong>Autor: {{$post->user->firstname}} {{$post->user->lastname}}</strong></p>
                                    <p>Zuletzt bearbeitet: {{$post->updated_at->format('d.m.Y')}}</p>
                                    @if($post->comments->count()>0)
                                        {{link_to_action('PostController@show', "Post mit Kommentaren ansehen", array('id' => $post->id), null)}}
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <p>Sichtbar: {{($post->public) ? "öffentlich" : "nur im eigenen Bereich"}}</p>
                                    <p>Status: {{$post->status->name}}</p>
                                    <p>Tags:
                                        @foreach ($post->tags()->orderBy('name')->get() as $key => $tag)
                                                <a class="tags_rendered" href= {{ action('PostController@withTag', ['tag' => $tag->id]) }} class="" >{{$tag->name}}</a>
                                        
                                        @endforeach
                                    
                                    </p>
                                </div>
                                
                                {{--  <div class="col-md-6">
                                    <span style="float:left; padding-top:16px; margin-right:10px">
                                        Tags:
                                    </span>
                                    <ul class="tagList">
                                    </ul>
                                </div>  --}}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
