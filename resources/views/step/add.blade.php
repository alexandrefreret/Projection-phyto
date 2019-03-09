@extends('layouts.app')
@section('content')
<h1>Enregister un stade</h1>
{!! Form::open(['route' => 'save_step']) !!}

	<div class="form-group">
		{{ Form::label("Céréales", null) }}
		{!! Form::select('cereals_group[]', $all_groups,null,array('multiple'=>'multiple', 'class' => 'form-control')); !!}
	</div>

	<div class="form-group">
		{{ Form::label("Nom", null) }}
		{{ Form::text("label", "", array_merge(['class' => 'form-control'])) }}
	</div>
	<div class="form-group">
		{{ Form::label("Etape min", null) }}
		{{ Form::text("min", "", array_merge(['class' => 'form-control'])) }}
	</div>
	<div class="form-group">
		{{ Form::label("Etape max (Laisser vide si pas une seule étape)", null) }}
		{{ Form::text("max", "", array_merge(['class' => 'form-control'])) }}
	</div>
	
	<div class="form-group">
		{!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']); !!}
	</div>
{!! Form::close() !!}

@endsection