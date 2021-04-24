@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Liste des clients
		<a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#modal-new">
			Nouveau client
		</a> <span class="clearfix"></span>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-inverse table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Tél.</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($clients as $client)
				<tr>
					<td>{{ $client->matricule }}</td>
					<td>{{ $client->nom }}</td>
					<td>{{ $client->prenom }}</td>
					<td>{{ $client->telephone }}</td>
					<td class="actions text-right"><a href="{{ route('s-client', $client) }}" class="text-success"><i class="fa fa-chevron-right"></i></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal-new">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="{{ route('a-compte') }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fermer</span>
					</button>
					<h4 class="modal-title">Nouveau client</h4>
				</div>
				<div class="modal-body">
					@if (session('error'))
					<div class="alert alert-danger"><i class="fa fa-info-circle fa-2x"></i> {{ session('error') }}</div>
					@endif
					{{ csrf_field() }}
					<fieldset class="form-group">
						<label>Prénom</label>
						<input type="text" class="form-control" id="prenom" placeholder="Le prenom du client" name="client[prenom]" required>
					</fieldset>
					<fieldset class="form-group">
						<label>Nom</label>
						<input type="text" class="form-control" id="nom" placeholder="Le nom du client" name="client[nom]" required>
					</fieldset>
					<fieldset class="form-group">
						<label>Sexe</label><br/>
						<label><input type="radio" placeholder="Le nom du client" name="client[sexe]" value="H"> Homme</label> &emsp;&emsp;
						<label><input type="radio" placeholder="Le nom du client" name="client[sexe]" value="F"> Femme</label>
					</fieldset>
					<fieldset class="form-group">
						<label>Téléphone</label>
						<input type="text" class="form-control" id="telephone" placeholder="Le numéro de téléphone du client" name="client[telephone]" required>
					</fieldset>
					<fieldset class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" id="email" placeholder="L'adresse email du client" name="client[email]">
					</fieldset>
					<fieldset class="form-group">
						<label>Solde en compte</label>
						<input type="number" class="form-control" id="solde" placeholder="Le solde de départ du client" name="solde" min="0" step="100">
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="submit" class="btn btn-primary">Enregistrer</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
