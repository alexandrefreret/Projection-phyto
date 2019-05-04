@extends('layouts.app')
@section('content')
	<div class="container">
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
	</div>
@endsection

@section("js_footer")

<script>
	$(document).ready(function(){

		
		
	});
</script>

@endsection