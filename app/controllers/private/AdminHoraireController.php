<?php

class AdminHoraireController extends \BaseController {
 
    public function horaire()
    {
        $typesSemaines = TypeSemaine::all();
        
        return View::make('private.pages.horaire')
                        ->with('typesSemaines', $typesSemaines);
    }
    
    public function newHoraire()
    {
        return View::make('private.forms.newHoraire');
    }
    
    public function selectLineToUpdate()
    {
        $lignes = DB::table('ligne')->groupBy('numero')->get();
        
        return View::make('private.forms.selectLineToUpdate')
                        ->with('lignes', $lignes);
    }
    
    public function findByLigne($ligne = 2, $idTypeSemaine = 3)
    {
        if(!isset($ligne)) $ligne = (int)Input::get('ligne')[0]; else $ligne = (int)$ligne;
        
        $date = date('d-m-Y');

        $horaires = Horaire::getHorairesByLigne($ligne, $date, null, null, $idTypeSemaine);
        $nomLigne = Ligne::findNameById($ligne);
        $nomTypeSemaine = TypeSemaine::getLibelleTypeSemaine($ligne);

        return View::make('private.forms.updateHoraire')
                        ->with('idLigne', $ligne)
                        ->with('nomLigne', $nomLigne)
                        ->with('idTypeSemaine', $idTypeSemaine)
                        ->with('nomTypeSemaine', $nomTypeSemaine)
                        ->with('horaires', $horaires);
    }
    
    public function updateHoraire()
    {
        $data = Input::all();
        extract($data);
        // $nomArret, $course, $idTypeSemaine, $idLigne, $sens
        
        $idArret = Arret::findIdByName($nomArret);
        
        dd(Horaire::changeHoraire($idArret, $course, $idTypeSemaine, $idLigne, $sens));
        
        
    }
    
    public function deleteTypeSemaine($id)
    {
        TypeSemaine::destroy($id);
        Session::flash('flash_msg', "Le type de semaine a bien été supprimé.");
        Session::flash('flash_type', "warning");
        return Redirect::to(URL::previous());
    }
    
    public function storeTypeSemaine()
    {
        $nature = '0000000X';
        $libelle = Input::get('libelle');
        $type = new TypeSemaine;
        
        (Input::get('lun')) ? $nature[0] = 1 : 0;
        (Input::get('mar')) ? $nature[1] = 1 : 0;
        (Input::get('mer')) ? $nature[2] = 1 : 0;
        (Input::get('jeu')) ? $nature[3] = 1 : 0;
        (Input::get('ven')) ? $nature[4] = 1 : 0;
        (Input::get('sam')) ? $nature[5] = 1 : 0;
        (Input::get('scol')) ? $nature[7] = "S" : 0;
        (Input::get('vac') &&  $nature[7] == "S") ? $nature[7] = "T" : (Input::get('vac')) ? $nature[7] = "V" : 0;
        // (Input::get('periode') == "scol") ? $nature[7] = "S" : 0;
        // (Input::get('periode') == "vac") ? $nature[7] = "V" : 0;
        // (Input::get('periode') == "scolvac") ? $nature[7] = "T" : 0;
        
        $type->libelleTypeSemaine = $libelle;
        $type->nature = $nature;
        $type->save();
        
        Session::flash('flash_msg', "Le nouveau type de semaine a bien été ajouté.");
        Session::flash('flash_type', "success");
        return Redirect::to(URL::previous());
        
    }
    
    
}