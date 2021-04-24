@extends('layouts.app-default')
<?php $en_ = $de_ = $det_ = 0; ?>

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Arrete Caisse {{ $caisse->date->format('d/m/Y') }}
		<span class="pull-right label label-info">Caisse de {{ $caisse->user->firstname }}</span>
	</div>
	<div class="panel-body">
		<table class="table table-inverse table-hover table-condensed table-bordered">
			<thead>
				<tr>
					<th class="text-center">Solde de veille</th>
					<th class="text-center">Approvisionnement</th>
					<th class="text-center">Creance</th>
					<th class="text-center">Heure d'ouverture</th>
					<th class="text-center">Heure de fermeture</th>
					<th class="text-center">Etat</th>
				</tr>
				<tr>
					<th class="text-center label-success">{{ number_format($caisse->veille, 0) }}</th>
					<th class="text-center label-success">{{ number_format($caisse->appro, 0) }}</th>
					<th class="text-center label-danger">{{ number_format($caisse->creance, 0) }}</th>
					<th class="text-center">{{ $caisse->created_at->format('H:i:s') }}</th>
					<th class="text-center">{{ $caisse->fermeture ? $caisse->fermeture->format('H:i:s') : '- - -' }}</th>
					<th class="text-center"><span class="label label-{{ $caisse->statut ?'success':'danger' }}">{{ $caisse->statut ?'arretee':'non arretee' }}</span></th>
				</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		{{-- <div class="breadcrumb text-center">
			<h5>Solde</h5>
			<h1 style="margin: 0" id="solde-html">{{ $caisse->solde ? number_format($caisse->solde, 0):'pas encore soldée' }}</h1>
		</div> --}}
		<div class="row">
			<div class="col-md-6">
				<table class="table table-condensed table-bordered">
					<caption>Mouvements de la caisse</caption>
					<thead>
						<tr>
							<th class="text-center">Service</th>
							<th class="text-center bg-success">Encaissement</th>
							<th class="text-center bg-danger">Decaissement</th>
							<th class="text-center">Solde</th>
						</tr>
					</thead>
					<tbody>
						@foreach($mouvements as $mouvement)
						<tr>
							<td>
								<img class="card-img-top img-responsive" src="{{ asset('img/' . $mouvement->service->logo) }}" style="width: 80px" alt="Logo service">
							</td>
							<td class="text-center bg-success" style="line-height: normal;">
								{{ number_format($mouvement->encaissement, 0) }}
							</td>
							<td class="text-center bg-danger" style="line-height: normal;">
								{{ number_format($mouvement->decaissement, 0) }}
							</td>
							<td class="text-center" style="line-height: normal;">
								{{ number_format($mouvement->encaissement - $mouvement->decaissement, 0) }}
							</td>
						</tr>
						<?php
						$en_+=$mouvement->encaissement;
						$de_+=$mouvement->decaissement;
						?>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center">Total</th>
							<th class="text-center label-success">{{ number_format($en_, 0) }}</th>
							<th class="text-center label-danger">{{ number_format($de_, 0) }}</th>
							<th class="text-center">{{ number_format($so_ = ($en_ - $de_), 0) }}</th>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table table-condensed table-bordered table-monnaie">
					<caption>Details de la caisse</caption>
					<thead>
						<tr>
							<th class="text-center">Billet/Piece</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Montant</th>
						</tr>
					</thead>
					<tbody>
						@foreach($details as $detail)
						<tr class="{{ $detail->monnaie->type ? 'bg-info':'' }}">
							<td class="text-right">{{ number_format($detail->monnaie->montant, 0) }}</td>
							<td class="text-right">{{ number_format($detail->nombre, 0) }}</td>
							<td class="text-right">{{ number_format($detail->monnaie->montant * $detail->nombre, 0) }}</td>
						</tr>
						<?php $det_ += $detail->monnaie->montant * $detail->nombre; ?>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right" colspan="2">Total</th>
							<th class="text-right">{{ number_format($det_, 0) }}</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="text-center">
					<h3>SOLDE</h3>
					<span class="label label-success">Solde de veille</span> + 
					<span class="label label-success">Approvisionnement</span> + 
					<span class="label label-success">Total encaissement</span> <br/>- 
					<span class="label label-danger">Creance</span> -
					<span class="label label-danger">Total decaissement</span>
					<h3 class="label-info p-3">
						{{ number_format($solde = $so_ + $caisse->veille + $caisse->appro - $caisse->creance, 0) }}
					</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-center">
					<h3>Ecart de caisse</h3>
					<span class="label label-success">SOLDE</span> - 
					<span class="label label-danger">Total caisse</span><br/><br/>
					<h3 class="label-info p-3">
						{{ number_format($solde - $det_, 0) }}
					</h3>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script_foot')
<script type="text/javascript">
	$('#pickerdate').datepicker({inline: true});
	// $('#solde-html').html('');
</script>
@endsection