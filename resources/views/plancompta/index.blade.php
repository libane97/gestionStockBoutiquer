@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Liste des plans
		<a href="#" class="btn btn-sm btn-info pull-right" data-toggle="modal" data-target="#modal-new">
			Nouveau plan
		</a> <span class="clearfix"></span>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-inverse table-hover">
			<thead>
				<tr>
					<th>compte</th>
					<th>Intitule</th>
					<th>Cpte. g</th>
					<th>Classe.</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($plans as $plan)
				<tr>
					<td>{{ $plan->compte }}</td>
					<td>{{ $plan->intitule }}</td>
					<td>{{ $plan->cptegen }}</td>
					<td>{{ $plan->classe }}</td>
					<td class="actions text-right"><a href="#" class="text-success"><i class="fa fa-chevron-right"></i></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>