@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#modal-add">Nouvelle opération</a>
		Client N° {{ $client->matricule }}</div>
		<div class="panel-body">
			<div class="media">
				<div class="media-body">
					<div class="row">
						<div class="col-md-3 text-center">
							<i class="fa fa-user fa-5x fa-fw"></i>
							<h4>{{ ($client->sexe ? 'M. ':'Mme. ') . sprintf('%s %s', $client->prenom, $client->nom) }}</h4>
						</div>
						<div class="col-md-3">
							<p>Téléphone: {{ $client->telephone }}</p>
							<p>Email: {{ $client->email }}</p>
							<p>Sexe: {{ $client->sexe }}</p>
						</div>
						<div class="col-md-3">
							<p>Compte N&deg; {{ $client->compte->numero }}</p>
							<p class="pa-0">Solde actuel: 
								<span class="label label-success" style="font-size: 15px">
									{{ number_format($client->compte->solde, 0) }}
								</span>
							</p>
						</div>
					</div>
					<hr/>
					<h4>Opérations</h4>
					@if($transactions->count() > 0)
					<table class="table table-inverse table-hover table-condensed">
						<thead>
							<tr>
								<th></th>
								<th>#</th>
								<th>Date</th>
								<th>Service</th>
								<th>Montant</th>
								<th>Motif</th>
								<th>User</th>
							</tr>
						</thead>
						<tbody>
							@foreach($transactions as $transaction)
							<tr>
								<td>
									<i class="fa fa-caret-{{ $transaction->operation->typeoperation->signe < 0 ?'down':'up' }} text-{{ $transaction->operation->typeoperation->signe < 0 ?'danger':'success' }}"></i>
								</td>
								<td>{{ $transaction->operation->code }}</td>
								<td>{{ $transaction->operation->created_at }}</td>
								<td>{{ $transaction->operation->service->libelle }}</td>
								<td>{{ number_format($transaction->operation->montant, 0) }}</td>
								<td>{{ $transaction->operation->typeoperation->nom }}</td>
								<td>{{ $transaction->operation->user->username }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@else
					<div class="alert alert-danger text-center">Aucune operation pour ce client</div>
					@endif
				</div>
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
					<h4 class="modal-title">Nouvelle opération</h4>
				</div>
				<div class="modal-body">
					<form action="{{ route('a-transaction') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="compte" value="{{ $client->compte->numero }}">
						<fieldset class="form-group">
							<div class="row">
								<div class="col-md-6">
									<fieldset class="form-group">
										<label for="libelle">Service</label>
										<select class="c-select form-control select" name="operation[service]">
											<option value="" selected>- - - selectionnez - - -</option>
											@foreach($services as $service)
											<option value="{{ $service->id }}">{{ $service->libelle }}</option>
											@endforeach
										</select>
									</fieldset>
								</div>
								<div class="col-md-6">
									<fieldset class="form-group">
										<label for="libelle">Type</label>
										<select class="c-select form-control select" name="operation[type]">
											<option value="" selected>- - - selectionnez - - -</option>
											@foreach($types as $type)
											<option value="{{ $type->id }}">{{ $type->nom }}</option>
											@endforeach
										</select>
									</fieldset>
								</div>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label for="montant">Montant de l'opération</label>
							<input type="number" min="0" step="100" class="form-control" id="montant" name="montant">
						</fieldset>
						<fieldset class="form-group">
							<label for="description">Remarque sur l'opération</label>
							<textarea class="form-control" id="description" rows="3" name="operation[description]"></textarea>
						</fieldset>
						<button type="submit" class="btn btn-primary">Valider</button>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
