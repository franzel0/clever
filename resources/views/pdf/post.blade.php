@extends('layouts.pdf')

@section('content')
    <div style="background-color: white; padding:10px; border: 1px solid grey; margin-bottom:10px;">
        <img src="{{asset('img/logo-raphaelsklinik-rgb.png')}}">
        <h3>Ein Beitrag aus der Wissensdatenbank der Raphaelsklinik</h3>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$post->title}}
        </div>
        <div class="panel-body">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-12">
                        <strong >Autor: {{$post->user->firstname}} {{$post->user->lastname}}, {{$post->section->name}}, Zuletzt bearbeitet: {{$post->updated_at->format('d.m.Y')}}</strong  >
                    </div>
                    <div class="col-md-12">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
