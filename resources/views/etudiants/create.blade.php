@extends('layouts.app')

@section('content')
<div class="container">
	@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
	@endif
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
                <div class="panel-heading">Nouveau etudiant</div>
                <div class="panel-body">
                    <form>
                    	<div class="form-group row">
                    		<label for="matricule" class="col-sm-2 form-control-label">Matricule</label>
                    		<div class="col-sm-10">
                    			<input type="text" class="form-control" id="matricule" placeholder="Matricule de l'etudiant">
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<label for="nom" class="col-sm-2 form-control-label">Nom</label>
                    		<div class="col-sm-10">
                    			<input type="text" class="form-control" id="nom" placeholder="Nom de l'etudiant">
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<label for="prenom" class="col-sm-2 form-control-label">prenom</label>
                    		<div class="col-sm-10">
                    			<input type="text" class="form-control" id="prenom" placeholder="prenom">
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<label for="datenaissance" class="col-sm-2 form-control-label">Date de naissance</label>
                    		<div class="col-sm-10">
                    			<input type="date" class="form-control" id="datenaissance">
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<label for="sexe" class="col-sm-2 form-control-label">Sexe</label>
                    		<div class="col-sm-10">
                    			<select name="sexe" class="form-control" required>
                    				<option value="1">Masculin</option>
                    				<option value="0">Feminin</option>
                    			</select>
                    		</div>
                    	</div>
                    	<div class="form-group row">
                    		<div class="col-sm-offset-2 col-sm-10">
                    			<button type="submit" class="btn btn-secondary">Enregistrer</button>
                    		</div>
                    	</div>
                    </form>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection