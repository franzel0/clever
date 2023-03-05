<div class="form-group">
    {!! Form::label('content', 'Inhalt') !!}

    <textarea class="form-control" required="required" name="content" cols="50" rows="10" id="content">
        @if(isset($comment))
            {!! $comment->content !!}
        @endif
    </textarea>
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

{{ Form::submit($submitbutton, ['id' => 'submitpost', 'class' => 'btn btn-primary']) }}
