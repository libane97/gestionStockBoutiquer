<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = [
    	'numfourn','raisoc', 'adresse', 'telfix', 'portable', 'email', 'fax', 'bp', 'banque', 'codebque',
    	'codeageance', 'cptebque', 'celerib', 'datedebspe', 'datedebconv', 'datefinconv', 'compte', 'region',
    	'pays', 'siteweb', 'codespe', 'ajout', 'agree', 'coordgeo'
    ];
}