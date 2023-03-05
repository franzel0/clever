@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $user->firstname }} {{$user->lastname }} bearbeiten
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif
                    {{ Form::model($user, ['method' => 'patch', 'id' => 'edituser', 'route' => ['user.update', $user->id]]) }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                        {!! Form::label('firstname', 'Vorname') !!}
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('firstname') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                        {!! Form::label('lastname', 'Nachname') !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('lastname') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'E-mail Adresse') !!}
                        {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                                {!! Form::label('section_id', 'Bereich', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('section_id', $optionsSections, $user->section_id, ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                                    <small class="text-danger">{{ $errors->first('section_id') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                                {!! Form::label('role_id', 'Berechtigung', ['class' => 'col-sm-3 control-label']) !!}
                                <div class="col-sm-9">
                                    {!! Form::select('role_id', $optionsRoles, $user->role_id, ['class' => 'form-control', 'required' => 'required', 'multiple']) !!}
                                    <small class="text-danger">{{ $errors->first('role_id') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-9">
                                    <div class="checkbox{{ $errors->has('active') ? ' has-error' : '' }}">
                                        <label for="active">
                                            {!! Form::checkbox('active', 1, null, ['id' => 'active']) !!} Benutzer ist aktiv
                                        </label>
                                    </div>
                                    <small class="text-danger">{{ $errors->first('active') }}</small>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="col-md-12">
                            {!! Form::submit('Speichern', ['class' => 'btn btn-info pullleft']) !!}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

    <script>
    tinymce.init({
        selector: '#content',
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    });

    $('#submitpost').on('click', function(e){
        tinyMCE.triggerSave();
        $('editform').submit();
    })
    </script>
@endsection
