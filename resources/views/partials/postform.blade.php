<div class="form-group">
    {!! Form::label('title', 'Titel') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

<div class="form-group">
    {!! Form::label('content', 'Inhalt') !!}

    <textarea class="form-control" required="required" name="content" cols="50" rows="10" id="content">
        @if(isset($post))
            {!! $post->content !!}
        @endif
    </textarea>
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

<div class="form-group">
  {!! Form::label('public', 'Öffentlich') !!}
  {!! Form::checkbox('public') !!}
  <small class="text-danger">{{ $errors->first('public') }}</small>
</div>

<div class="form-group">
    {!! Form::label('status_id', 'Status') !!}
    {!! Form::select('status_id', $statuslist, null, ['placeholder' => 'Bitte einen Status auswählen!']) !!}
    <small class="text-danger">{{ $errors->first('status_id') }}</small>
</div>

<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
    {!! Form::label('tags', 'Tags') !!}
    {!! Form::select('tags[]', $tagList, isset($post) ? $post->tags()->pluck('id') : null, ['id' => 'tagList', 'class' => 'form-control', 'multiple']) !!}
    <small class="text-danger">{{ $errors->first('tags') }}</small>
</div>

{{ Form::submit($submitbutton, ['id' => 'submitpost', 'class' => 'btn btn-primary']) }}
