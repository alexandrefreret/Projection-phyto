@extends('layouts.app')
@section('content')
<h1>Choisir un ou plusieurs produits</h1>
{!! Form::open(['route' => 'add_product']) !!}

	<div class="form-group">
		{{ Form::label("Produits", null) }}
		{{-- {!! Form::select('produits[]', $all_products,null,array('multiple'=>'multiple', 'class' => 'form-control')); !!} --}}
		<select name="produits[]" class="form-control" multiple id="">
			@foreach ($all_products as $cereals => $tab)
				<optgroup label="{{ $cereals }}">
					@foreach($tab as $produit)
						<option value="">{{ $produit["libelle"] }}</option>
					@endforeach
				</optgroup>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		{!! Form::submit('Choisir', ['class' => 'btn btn-primary']); !!}
	</div>
{!! Form::close() !!}

@endsection