<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} - DIE WISSENSDATENBANK
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li class="{{ Request::route()->getName() == 'post.index' ? 'active' : '' }}">
                            <a href="{{ url('post') }}">
                                Beiträge
                            </a>
                        </li>
                        @if(isset($unpublishedcount) and $unpublishedcount>0)
                            <li class="{{ Request::route()->getName() == 'unpublished' ? 'active' : '' }}">
                                <a href="{{ url('unpublished') }}">
                                    <strong class="unpublished">
                                        Entwürfe ({{ $unpublishedcount }})
                                    </strong>
                                </a>
                            </li>
                        @endif
                        @if(isset($tobepublishedcount) and $tobepublishedcount>0 and Gate::allows('publish-post'))
                            <li class="{{ Request::route()->getName() == 'tobepublished' ? 'active' : '' }}">
                                <a href="{{ url('tobepublished') }}">
                                    <strong class="tobepublished">
                                        Freizugeben! ({{ $tobepublishedcount }})
                                    </strong>
                                </a>
                            </li>
                        @endif
                        <li class="{{ Request::route()->getName() == 'post.create' ? 'active' : '' }}">
                            <a href="{{ route('post.create') }}">
                                Neuer Post
                            </a>
                        </li>
                        @can('isAdmin')
                            <li class="{{ Request::route()->getName() == 'user.index' ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}">
                                    Benutzer
                                </a>
                            </li>
                        @endcan
                        <li>
                            <a href="{{ route('test') }}">
                                Test
                            </a>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid rowtop">
        <div class="row">
            <div class="col-md-9">
                @yield('content')
            </div>
            @if(Auth::check())
                <div class="col-md-3">
                    <div class="well">
                        <strong>TAGS</strong>
                        <hr />
                        @foreach ($tagscloud as $key => $tag)
                            <span style="margin-top: 5px, margin-right: 5px; font-size: {{14 + intVal($tag->tag_count/$tags_count*50)}}px    ">
                                <a href= {{ action('PostController@withTag', ['tag' => $tag->id]) }} class="" >{{$tag->name}}</a>
                            </span>
                        @endforeach
                        <br />
                        <br />
                        {!! Form::open(['method' => 'GET', 'action' => 'PostController@tag']) !!}
                        <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                            {!! Form::label('tag', 'TAG AUSWÄHLEN') !!}
                            <hr />
                            {!! Form::select('tag', $tag_list, null, ['id' => 'select_tag', 'class' => 'form-control select2', 'required' => 'required', 'multiple']) !!}
                            <small class="text-danger">{{ $errors->first('tag') }}</small>
                            {!! Form::submit('Suchen') !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="well">
                        <strong>BEITRAG SUCHEN</strong>
                        <hr />
                        {!! Form::open(['action' => 'PostController@search']) !!}
                        {!! Form::text('search') !!}
                        <br />
                        {!! Form::submit('Los!') !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
        </div>
    </div>

@yield('scripts')
<script>
$( document ).ready(function() {
    $('#select_tag').select2();
});
</script>

</body>
</html>
