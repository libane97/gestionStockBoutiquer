@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Opération N° {{ $operation->code }}</div>
	<div class="panel-body">
		<table class="table table-inverse table-hover">
			<tbody>
				<tr>
					<th>Fait le</th>
					<th>{{ $operation->created_at->format('d/m/Y H:i:s') }}</th>
				</tr>
				<tr>
					<th>Service</th>
					<th>{{ $operation->service->libelle }}</th>
				</tr>
				<tr>
					<th>Montant</th>
					<th>{{ number_format($operation->montant, 0) }}</th>
				</tr>
				<tr>
					<th>Type</th>
					<th>{{ $operation->typeoperation->nom }}</th>
				</tr>
				<tr>
					<th>Client</th>
					<th>{{ $operation->is_client ? '':'' }}</th>
				</tr>
				<tr>
					<th>Effectue par</th>
					<th>{{ sprintf('%s %s', $operation->user->firstname, $operation->user->name) }}</th>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection