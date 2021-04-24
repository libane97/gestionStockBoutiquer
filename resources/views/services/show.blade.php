@extends('layouts.app-default')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Liste des services<span class="clearfix"></span></div>

	<div class="panel-body">
		{{ dd($service) }}
	</div>
</div>
@endsection