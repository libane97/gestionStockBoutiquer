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
		<form action="{{ route('u-service', $service) }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<fieldset class="form-group">
				<label for="libelle">Nom du service</label>
				<input type="text" class="form-control" id="libelle" required value="{{ $service->libelle }}" name="libelle">
			</fieldset>
			<fieldset class="form-group">
				<label for="description">Description du service</label>
				<textarea class="form-control" id="description" rows="3" name="description">{{ $service->description }}</textarea>
			</fieldset>
			<fieldset class="form-group">
				<label for="logo">Logo</label>
				<input type="file" class="form-control-file" id="logo" name="logo">
			</fieldset>
			<div class="checkbox">
				<label><input type="checkbox" name="active" checked="{{ $service->active }}"> Disponible</label>
			</div>
			<button type="submit" class="btn btn-primary">Valider</button>
		</form>
	</div>
</div>
@endsection