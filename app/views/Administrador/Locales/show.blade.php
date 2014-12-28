@extends('templates.adminTemplate')
@section('contenido')

	<div class="container-fluid">
		<h2 class="titul">{{$local}}</h2>
		<div class="row">
		@if(!count($Info)==0)		
			@foreach($depto as $value)
				@foreach($Info as $key)
					@if($key->id_dpto==$value->id)
						<?php $value->id+=17; ?>
						<div class="col-md-4">
						<div>
							<img class="img-responsive" src="{{ asset( 'img/'.$key->foto.'') }}" alt="" style="background:red;">
						</div>
							<a href="{{ URL::to('/administrador/Locales/Show/'.$local.'/'.$value->nombre.'') }}"><h2 class="titul">{{$value->nombre}}</h2></a>
						</div>																		
					@endif
				@endforeach
			@endforeach
		@else
			<h2 class="titul">No se ha encontrado ninguna informacion</h2>
		@endif
		</div>
	</div>
@stop