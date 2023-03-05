@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Neuer Kommentar
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::open(['route' => ['post.comment.store', $post_id]]) }}
                                @include('partials.commentform', ['submitbutton' => 'Erstellen'])
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
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
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        formats: {
            table_default_attributes: {class: 'tinyTable'}
        }
      });

      $('#submitpost').on('click', function(e){
          tinyMCE.triggerSave();
          $('editform').submit();
      })
     </script>
@endsection
