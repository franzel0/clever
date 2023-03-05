@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $tag->name }}  bearbeiten
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    @if (session('alert'))
                        <div class="alert alert-success">
                            {{ session('alert') }}
                        </div>
                    @endif
                    {{ Form::model($tag, ['method' => 'patch', 'id' => 'edittag', 'route' => ['tag.update', $tag->id]]) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Speichern', ['class' => 'btn btn-info pullleft']) !!}
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
