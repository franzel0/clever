@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Tag: {{$tag->name}}
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach ($posts as $key => $post)
                    <div class="col-md-12">
                        <div class="well">
                            <div class="col-md-10">
                                {!! $post->title!!}
                            </div>
                            <div class="col-md-2">
                                {{link_to_action('PostController@show', "Post ansehen", array('id' => $post->id), null)}}
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <strong >Autor: {{$post->user->firstname}} {{$post->user->lastname}}, {{$post->section->name}}</strong>
                            </div>
                            <div class="col-md-6">
                                Zuletzt bearbeitet: {{$post->updated_at->format('d.m.Y')}}
                            </div>
                            <br />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
