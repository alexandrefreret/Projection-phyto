@extends('layouts.app')
@section('content')
<h1>Choisir une ou plusieurs cultures</h1>
{!! Form::open(['route' => 'list_product']) !!}

	<div class="form-group">
		{{ Form::label("Céréales", null) }}
		{!! Form::select('cereals_group[]', $all_groups,null,array('multiple'=>'multiple', 'class' => 'form-control')); !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Choisir', ['class' => 'btn btn-primary']); !!}
	</div>
{!! Form::close() !!}
@endsection