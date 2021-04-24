@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Solder la Caisse du {{ $caisse->date->format('d/m/Y') }}</div>
	<div class="panel-body">
		<form method="post" action="{{ route('a-solde', $caisse) }}" name="form" id="form">
			{{ csrf_field() }}
			<table class="table table-inverse table-hover table-condensed table-bordered">
				<thead>
					<tr>
						<th class="text-center">Heure d'ouverture</th>
						<th class="text-center">Solde de veille</th>
						<th class="text-center">Approvisionnement</th>
						<th class="text-center">Creance</th>
						<th class="text-center">Etat</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center">{{ $caisse->created_at->format('H:i:s') }}</td>
						<td class="text-center">{{ number_format($caisse->veille, 0) }}</td>
						<td class="text-center">
							<input type="number" name="caisse[appro]" class="form-control" min="0" value="{{$caisse->appro}}" style="height: 25px;text-align: center;" required>
						</td>
						<td class="text-center">
							<input type="number" name="caisse[creance]" class="form-control" min="0" value="{{$caisse->creance}}" style="height: 25px;text-align: center;" required>
						</td>
						<td class="text-center">
							<span class="label label-{{ $caisse->statut ? 'success':'danger' }}">
								{{ $caisse->statut ? 'arretee':'non arretee' }}</span>
							</td>
						</tr>
					</tbody>
			</table>
			<div class="row">
				<div class="col-md-6">
					<table class="table table-inverse table-hover table-condensed table-bordered table-striped">
						<caption>Mouvements de la caisse</caption>
						<thead>
							<tr>
								<th>Service</th>
								<th>Encaissement</th>
								<th>Decaissement</th>
							</tr>
						</thead>
						<tbody>
							@foreach($services as $service)
							<input type="hidden" name="mouvements[{{$service->id}}][service_id]" class="form-control" value="{{$service->id}}">
							<input type="hidden" name="mouvements[{{$service->id}}][caisse_id]" class="form-control" value="{{$caisse->id}}">
							<tr>
								<td>{{ $service->libelle }}</td>
								<td class="form-group">
									<input type="text" name="mouvements[{{$service->id}}][encaissement]" class="form-control" style="height: 25px;text-align: center;" required>
								</td>
								<td class="form-group">
									<input type="text" name="mouvements[{{$service->id}}][decaissement]" class="form-control" style="height: 25px;text-align: center;" required>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table table-inverse table-condensed table-bordered">
						<caption>Details de la caisse</caption>
						<thead>
							<tr>
								<th class="text-center">Billet/Piece</th>
								<th class="text-center">Nombre</th>
								<th class="text-center">Montant</th>
							</tr>
						</thead>
						<tbody>
							@foreach($monnaies as $monnaie)
							<input type="hidden" name="details[{{$monnaie->id}}][monnaie_id]" class="form-control" value="{{$monnaie->id}}">
							<input type="hidden" name="details[{{$monnaie->id}}][caisse_id]" class="form-control" value="{{$caisse->id}}">
							<tr class="{{ $monnaie->type ? 'bg-info':'' }}">
								<td class="text-right">{{ number_format($monnaie->montant, 0) }}</td>
								<td style="max-width: 80px">
									<input type="number" name="details[{{$monnaie->id}}][nombre]" class="form-control i_details" min="0" style="height: 25px;text-align: center;" data-monnaie="{{$monnaie->montant}}" data-print="l_details_{{ $monnaie->id }}" required>
								</td>
								<td class="text-right"><span id="l_details_{{ $monnaie->id }}"></span></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-info btn-lg">Valider</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script_foot')
<script type="text/javascript">
	$('.i_details').on('change keyup paste', function() {
		var montant = numeral(($(this).val() * $(this).attr('data-monnaie'))).format('0,0[.]00');
		$('#' + $(this).attr('data-print')).html(montant);
	});
</script>
@endsection