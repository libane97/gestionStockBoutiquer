@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Bilan
	</div>
	<div class="panel-body">
		<div>
			<div class="form-group">
				<input type="text" style="display: none" id="pickerdate" class="form-control" data-language='fr' data-range="true"
				data-multiple-dates-separator=" - " name="date" placeholder="Intervalle" />
			</div>
		</div>
		<table class="table table-inverse table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th>#</th>
					@foreach($types as $type)
					<th>{{ $type->nom }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($services as $service)
				<tr>
					<td>
						<img src="{{ asset('img/' . $service->logo) }}" style="max-width: 80px">
					</td>
					@foreach($types as $type)
					<td>
						<h4 class="text-center" style="line-height: normal;">{{ number_format(rand(1000,99999), 0) }}</h4>
					</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal-new">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="{{ route('a-operation') }}" name="form" id="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fermer</span>
					</button>
					<h4 class="modal-title">Nouvelle operation</h4>
				</div>
				<div class="modal-body" ng-controller="cpController">
					@if (session('error'))
					<div class="alert alert-danger"><i class="fa fa-info-circle fa-2x"></i> {{ session('error') }}</div>
					@endif
					{{ csrf_field() }}
					<fieldset class="form-group">
						<label><input type="radio" name="is_client" value="0" ng-checked="true" ng-model="is_client">
							Sans client &emsp;&emsp;
						</label>
						<label><input type="radio" name="is_client" value="1" ng-model="is_client">
							Avec client
						</label>
					</fieldset>
					<fieldset class="form-group" ng-show="is_client==1">
						<div class="input-group">
							<input type="text" name="holder_s" class="form-control" placeholder="Numero de compte / numero de telephone / email" ng-model="key">
							<span class="input-group-btn">
								<button class="btn btn-secondary" type="button" id="btn_s" ng-click="searchClient()">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</fieldset>
					<fieldset class="form-group alert alert-@{{compte.client?'info':'danger'}}" ng-show="is_client==1" ng-if="compte && !loading">
						<input type="hidden" name="compte" ng-value="compte.numero">
						<div class="row" ng-if="compte.client">
							<div class="col-md-3 text-center">
								<i class="fa fa-user fa-5x fa-fw"></i>
								<h5>
									<b>@{{ (compte.client.sexe=='H'?'M. ':'Mme. ') + compte.client.prenom +' '+compte.client.nom }}</b>
								</h5>
							</div>
							<div class="col-md-5">
								<p class="small">Téléphone: <b>@{{ compte.client.telephone }}</b></p>
								<p class="small">Email: <b>@{{ compte.client.email }}</b></p>
								<p class="small">Sexe: <b>@{{ compte.client.sexe }}</b></p>
							</div>
							<div class="col-md-4">
								<p class="small">Compte N&deg; <br/> <b>@{{ compte.numero }}</b></p>
								<p class="pa-0">Solde actuel: <br/>
									<span class="label label-success" style="font-size: 15px">
										<b>@{{ compte.solde | number }}</b>
									</span>
								</p>
							</div>
						</div>
						<div ng-if="!compte.client">Aucune donnee recue</div>
					</fieldset>
					<div ng-show="loading" class="alert text-center"><i class="fa fa-spinner fa-spin fa-4x"></i></div>
					<fieldset class="form-group">
						<div class="row">
							<div class="col-md-6">
								<fieldset class="form-group">
									<label for="libelle">Service</label>
									<select class="c-select form-control select" name="service" ng-model="service" required>
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
									<select class="c-select form-control select" name="type" ng-model="type" required>
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
						<input type="number" min="0" max="10000000" step="100" class="form-control" id="montant" name="montant" ng-model="montant" required>
						<label class="label label-success mt-1" ng-show="montant">@{{ montant|number }}</label>
					</fieldset>
					<fieldset class="form-group">
						<label for="description">Remarque sur l'opération</label>
						<textarea class="form-control" id="description" rows="3" name="description"></textarea>
					</fieldset>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_reset">Annuler</button>
					<button type="submit" class="btn btn-primary" ng-disabled="form.$touched && (form.service.$invalid || form.type.$invalid || form.montant.$invalid)">Enregistrer</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script_foot')
<script type="text/javascript">
	$('#pickerdate').datepicker({inline: true});
	$('#btn_reset').click(function() {
		document.getElementById("form").reset();
	});
	// $('#btn_s').click(function() {
	// 	var key = $('#holder_s').val();
	// 	if(!key)
	// 		alert('Veuillez saisir une information');
	// 	else {
	// 		$.post('{{ url('api/client/search') }}', { key: key }, function(response, textStatus, jqXHR) {
	// 			console.log(response);
	// 		}).done(function( data ) {
	// 	    	console.log(data);
	// 	  	});
	// 		// .error(function() { alert('Impossible de trouver un resultat') });
	// 	}
	// });
	// $('#etablissement').change(function() {
	// 	$('#classe').empty();
	// 	$('#classe').attr('readonly', true);
	// 	$.get("http://helloschool.sn/api/etablissements/" + $(this).val() + "/classes", function(classes, textStatus, jqXHR) {
	// 		$('#classe').append('<option value="">- - - selectionner une classe - - -</option>');
	// 		$.each(classes, function(key, classe) {
	// 			$('#classe').append('<option value="' + classe.id + '">' + classe.libelle + '</option>');
	// 		});
	// 	}).
	// 	complete(function() { $('#classe').attr('readonly', false); }).
	// 	error(function() { alert('Impossible de trouver un resultat') });
	// });
</script>
@endsection
