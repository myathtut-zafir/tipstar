@extends('admin.layouts.master')

@section('content')

<div class="row">
    <div class="col-sm-10 col-sm-offset-2">
        <h1>{{ trans('quickadmin::templates.templates-view_edit-edit') }}</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
        @endif
    </div>
</div>

{!! Form::model($tipsters, array('class' => 'form-horizontal', 'id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array(config('quickadmin.route').'.tipsters.update', $tipsters->id))) !!}

<div class="form-group">
    {!! Form::label('name', 'name*', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('name', old('name',$tipsters->name), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('image', 'image', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('image', old('image',$tipsters->image), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('view_count', 'view_count', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('view_count', old('view_count',$tipsters->view_count), array('class'=>'form-control')) !!}
        
    </div>
</div><div class="form-group">
    {!! Form::label('win_rate', 'win_rate', array('class'=>'col-sm-2 control-label')) !!}
    <div class="col-sm-10">
        {!! Form::text('win_rate', old('win_rate',$tipsters->win_rate), array('class'=>'form-control')) !!}
        
    </div>
</div>

<div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      {!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}
      {!! link_to_route(config('quickadmin.route').'.tipsters.index', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
    </div>
</div>

{!! Form::close() !!}

@endsection