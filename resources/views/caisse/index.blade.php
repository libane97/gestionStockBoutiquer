@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#modal-new">Nouvelle caisse</a>
		Liste des caisses
	</div>
	<div class="panel-body">
		<div class="">
			<form class="form-inline" method="get" action="">
				<div class="form-group">
					<input type="text" id="pickerdate" class="form-control" data-language='fr' data-range="true"
					data-multiple-dates-separator=" - " name="date" placeholder="Intervalle" />
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<table class="table table-inverse table-hover table-condensed">
			<thead>
				<tr>
					<th>#</th>
					<th>Date</th>
					<th>Solde veille</th>
					<th>Approvisionnement</th>
					<th>Creance</th>
					<th>Ouverture</th>
					<th>Fermeture</th>
					<th>Solde arrete</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($caisses as $caisse)
				<tr class="{{ $caisse->statut > 0 ? 'bg-success':'' }}">
					<td>
						<i class="fa fa-{{ $caisse->statut > 0 ?'check':'ban' }} text-{{ $caisse->statut ?'success':'danger' }}"></i>
					</td>
					<td>{{ $caisse->date->format('d/m/Y') }}</td>
					<td>{{ number_format($caisse->veille, 0) }}</td>
					<td>{{ number_format($caisse->appro, 0) }}</td>
					<td>{{ number_format($caisse->montant, 0) }}</td>
					<td>{{ $caisse->created_at->format('d/m/Y H:i:s') }}</td>
					<td>{{ $caisse->fermeture or '- - -' }}</td>
					<td>{{ number_format($caisse->solde, 0) }}</td>
					<td class="actions text-right">
						@if(!$caisse->fermeture)
						<a href="{{ route('d-caisse', $caisse) }}" class="text-danger"><i class="fa fa-archive fa-fw"></i></a>
						@endif
						<a href="{{ route('s-caisse', $caisse) }}" class="text-success"><i class="fa fa-eye fa-fw"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal-new">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form method="post" action="{{ route('a-caisse') }}" name="form" id="form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Fermer</span>
					</button>
					<h4 class="modal-title">Nouvelle caisse</h4>
					<p class="h3 text-danger">{{ date('d/m/Y') }}</p>
				</div>
				<div class="modal-body" ng-controller="cpController">
					@if (session('error'))
					<div class="alert alert-danger"><i class="fa fa-info-circle fa-2x"></i> {{ session('error') }}</div>
					@endif
					{{ csrf_field() }}
					<div class="form-group">
						<label>Solde de veille</label>
						<input type="number" id="veille" class="form-control" name="veille" placeholder="Montant solde veille" />
					</div>
					<div class="form-group">
						<label>Caissier(e)</label>
						<p>{{ Auth::user()->firstname }}</p>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Valider</button>
					</div>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('script_foot')
<script type="text/javascript">
	$(document).ready(function() {
		$('#pickerdate').datepicker({timepicker: false});
		$('#btn_reset').click(function() {
			document.getElementById("form").reset();
		});
	});
</script>
@endsection
