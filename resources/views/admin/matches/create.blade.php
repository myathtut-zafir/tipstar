@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::templates.templates-view_create-add_new') }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::open(array('route' => config('quickadmin.route').'.match.store', 'id' => 'form-with-validation', 'class' => 'form-horizontal')) !!}

    <div class="form-group">
        {!! Form::label('league', 'League', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">

            <select name="league" class="form-control" id="league" required>
                <option value="">Please Select Leagues</option>
                @foreach($leagues as $key=>$value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('home_team', 'Home Team', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">

            <select name="home_team" class="form-control" id="home_team" required>
                <option value="">Please Select Home Team</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('away_team', 'Away Team', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">

            <select name="away_team" class="form-control" id="away_team" required>
                <option value="">Please Select Away Team</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('goal', 'Goal', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">

            {!! Form::text('goal_over_under', old('goal_over_under'), array('class'=>'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('match_start', 'Match Start', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">
            <input type="datetime-local" class="form-control" name="match_start">
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('week_number', 'Week Number', array('class'=>'col-sm-2 control-label font-myan')) !!}
        <div class="col-sm-3">
            <select name="week_number" class="form-control" id="week_number" required>
                <option value="">Please Select Goal Type</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('latest_odd', 'Odd', array('class'=>'col-sm-2 control-label')) !!}
        <div class="col-sm-3">
            <input type="text" class="form-control" name="latest_odd">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection