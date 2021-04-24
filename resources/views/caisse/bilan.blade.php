@extends('layouts.app-default')
<?php $tap_ = 0; $tcr_ = 0; $ten_ = 0; $tde_ = 0; ?>
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Bilan </div>
	<div class="panel-body">
		<div class="row">
			<form class="form-inline col-md-4" method="get" action="">
				<div class="form-group">
					<input type="text" id="pickerdate" class="form-control" data-language='fr' name="date" placeholder="Date" />
				</div>
				<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<div class="row">
			@foreach($caisses as $caisse)
			<?php $det_ = 0; $en_ = 0; $de_ = 0; $tap_+=$caisse->appro; $tcr_+=$caisse->creance; ?>
			<div class="col-md-6">
				<table class="table table-inverse table-hover table-condensed table-bordered">
					<caption>{{ $caisse->user->firstname }}</caption>
					<tbody>
						<tr><td>Solde de veille</td><th class="text-right">{{ number_format($caisse->veille, 0) }}</th></tr>
						<tr><td>Approvisionnement</td><th class="text-right">{{ number_format($caisse->appro, 0) }}</th></tr>
						<tr><td>Creance</td><th class="text-right">{{ number_format($caisse->creance, 0) }}</th></tr>
						<tr>
							<td>Heure d'ouverture</td>
							<th class="text-right">{{ $caisse->created_at->format('d/m/Y H:i:s') }}</th>
						</tr>
						<tr>
							<td>Heure de fermeture</td>
							<th class="text-right">{{ $caisse->fermeture ? $caisse->fermeture->format('d/m/Y H:i:s') : '...' }}</th>
						</tr>
						<tr><td>Etat</td><th class="text-right"></th></tr>
					</tbody>
				</table>
				<table class="table table-condensed table-bordered">
					<thead>
						<tr>
							<tr><th colspan="3" class="text-center">Mouvements de la caisse de {{ $caisse->user->firstname }}</th></tr>
							<th class="text-center">Service</th>
							<th class="text-center bg-success">Encaissement</th>
							<th class="text-center bg-danger">Decaissement</th>
						</tr>
					</thead>
					<tbody>
						@foreach($caisse->mouvements as $mouvement)
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
						</tr>
						<?php
						$en_+=$mouvement->encaissement;
						$de_+=$mouvement->decaissement;
						?>
						@endforeach
						<?php
							$ten_+=$en_;
							$tde_+=$de_;
						?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-center">Total</th>
							<th class="text-center label-success">{{ number_format($en_, 0) }}</th>
							<th class="text-center label-danger">{{ number_format($de_, 0) }}</th>
						</tr>
					</tfoot>
				</table>
				<table class="table table-condensed table-bordered table-monnaie">
					<thead>
						<tr><th colspan="3" class="text-center">Details de la caisse de {{ $caisse->user->firstname }}</th></tr>
						<tr>
							<th class="text-center">Billet/Piece</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Montant</th>
						</tr>
					</thead>
					<tbody>
						@foreach($caisse->details as $detail)
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
			@endforeach
		</div>
		<div class="table-responsive">
			<table class="table table-inverse table-hover table-condensed table-bordered">
				<caption>Bilan journalier</caption>
				<tbody>
					<tr><td>Total approvisionnement</td><th class="text-right">{{ number_format($tap_, 0) }}</th></tr>
					<tr><td>Total creance</td><th class="text-right">{{ number_format($tcr_, 0) }}</th></tr>
					<tr><td>Total encaissement</td><th class="text-right">{{ number_format($ten_, 0) }}</th></tr>
					<tr><td>Total decaissement</td><th class="text-right">{{ number_format($tde_, 0) }}</th></tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section('script_foot')
<script type="text/javascript">$('#pickerdate').datepicker();</script>
@endsection
