@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-add" class="btn btn-info pull-right">
			<i class="fa fa-plus"></i>
		</a>Liste des services
		<span class="clearfix"></span>
	</div>

	<div class="panel-body">
		<div class="row">
			@foreach($services as $service)
			<div class="col-md-3">
				<div class="card text-center py-3" style="height: 190px">
					<a href="{{ route('e-service', $service) }}">
						<img class="card-img-top" src="{{ asset('img/' . $service->logo) }}" style="width: 120px" alt="Logo {{ $service->libelle }}">
					</a>
					<div class="card-block">
						<h5 class="card-title">{{ $service->libelle }}</h5>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
<div class="modal fade" id="modal-add">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Fermer</span>
				</button>
				<h4 class="modal-title">Nouveau service</h4>
			</div>
			<div class="modal-body">
				<form action="{{ route('a-service') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<fieldset class="form-group">
						<label for="libelle">Nom du service</label>
						<input type="text" class="form-control" id="libelle" required name="libelle">
					</fieldset>
					<fieldset class="form-group">
						<label for="description">Description du service</label>
						<textarea class="form-control" id="description" rows="3" name="description"></textarea>
					</fieldset>
					<fieldset class="form-group">
						<label for="logo">Logo</label>
						<input type="file" class="form-control-file" id="logo" name="logo">
					</fieldset>
					<div class="checkbox">
						<label><input type="checkbox" name="active"> Disponible</label>
					</div>
					<button type="submit" class="btn btn-primary">Valider</button>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
