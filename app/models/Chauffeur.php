<?php

class Chauffeur extends Eloquent{

	public $primaryKey = 'idChauffeur';
	public $timestamps = false;
	protected $table = 'chauffeur';
	public $fillable = ['nomChauffeur', 'prenomChauffeur', 'loginChauffeur', 'mdpChauffeur'];

}
