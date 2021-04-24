<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
    	'matricule', 'matipm', 'nom', 'prenom', 'sexe', 'sitfam', 'datenaiss', 'lieunaiss',
    	'region', 'pays','adresse', 'portable', 'email', 'dateemb', 'numcont', 'etatcont', 'datesous', 'dateres',
    	'codesoc', 'codeserv', 'codeaffect', 'compte', 'numfiche', 'datedebcarte', 'datefincarte', 'nbfemme', 'nbenfant',
    	'dateradiation', 'cin', 'typecontrat', 'categprof', 'datecreationpart', 'photo', 'etat', 'matmut', 'codecotis'
    ];
}
