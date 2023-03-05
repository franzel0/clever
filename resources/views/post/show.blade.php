@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$post->title}}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10">
                                <strong >Autor: {{$post->user->firstname}} {{$post->user->lastname}}, {{$post->section->name}}, Zuletzt bearbeitet: {{$post->updated_at->format('d.m.Y')}}</strong  >
                            </div>
                            @can('edit', $post)
                                <div class="col-md-2" style="margin-bottom:10px;">
                                    <a href= {{ action('PostController@reset', ['id' => $post->id]) }} class="btn btn-sm btn-danger pull-right" >Zurücksetzen</a>
                                </div>
                            @endcan
                            <div class="col-md-12 well">
                                {!! $post->content !!}
                            </div>
                            @foreach ($post->comments as $key => $comment)
                                <div class="col-md-10 col-md-offset-2 well well-sm">
                                    {{$comment->user->firstname}} {{$comment->user->lastname}} schrieb am {{$comment->created_at->format('d.m.Y, h:m')}} Uhr
                                    @if($post->updated_at > $comment->updated_at)
                                        <strong style="color:red">
                                            <br />
                                            Der Beitrag wurde nach diesem Kommentar bearbeitet
                                        </strong>
                                    @endif
                                    <hr />
                                    {!! $comment->content !!}
                                    @can('update', $comment)
                                        <a href= {{ action('CommentController@update', ['post' => $post->id, 'comment' => $comment->id]) }} class="btn btn-warning pull-right" >Bearbeiten</a>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
