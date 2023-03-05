@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Neuer Post
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    {{ Form::open(['action' => 'PostController@store', 'id' => 'editpost']) }}
                    @include('partials.postform', ['submitbutton' => 'Erstellen'])
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
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        language: 'de'
    });

    $('#submitpost').on('click', function(e){
        tinyMCE.triggerSave();
        $('editform').submit();
    })

    $('#tagList').select2({
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        }
    });
    </script>
@endsection
