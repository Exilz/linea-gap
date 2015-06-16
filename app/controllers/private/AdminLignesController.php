<?php

class AdminLignesController extends \BaseController{
    
    public function lignes()
    {
        $lignes = Ligne::all();
        return View::make('private.pages.lignes')->with('lignes', $lignes);
    }
    
    public function edit($id)
    {
        $ligne = Ligne::find($id);
        return View::make('private.forms.updateLigne')->with('ligne', $ligne);
    }
    
    public function update($id)
    {
        $ligne = Ligne::find($id);
        $ligne->fill(Input::all());
        
        if(Input::hasFile('fichierPDF'))
        {
            $fichierPDF = Input::file('fichierPDF');
            $extension = strtolower($fichierPDF->getClientOriginalExtension());
            
            if($extension == "pdf")
            {
                $path = public_path() . '/uploads';
                $fileName = "horaires" . $ligne->idLigne . ".pdf";
                $fichierPDF->move($path, $fileName);
                $ligne->fichierPDF = $fileName;
            }
        }
        
        $ligne->save();
        Session::flash('flash_msg', "La ligne" . $ligne->libelleLigne . " a bien été modifiée.");
        Session::flash('flash_type', "success");
        return Redirect::to('/admin/lignes');
    }
    
    public function getArretsCoords()
    {
        header('Access-Control-Allow-Origin: *');  
        $idLigne = Input::get('idLigne');
        $sens = Input::get('sens');
        if(is_null(Input::get('date'))) $date = date('d-m-Y'); else $date = Input::get('date');
        $results = [];
        $typesSemaines = TypeSemaine::getIdType($date);
        
        if($typesSemaines)
        {
    		$idSemaine = 	DB::table('horaire')
    							->remember(120)
    							->where('idLigne', '=', $idLigne)
    							->whereIn('idTypeSemaine', $typesSemaines)
    							->groupBy('idTypeSemaine')
    							->lists('idTypeSemaine');
    							
							
			$arrets = DB::table('horaire')
							->where('idLigne', '=', $idLigne)
							->where('idTypeSemaine', '=', $idSemaine)
							->where('sens', '=', $sens)
							->orderBy('ordre1')
							->groupBy('ordre1')
							->lists('idArret');
							
            foreach($arrets as $idArret)
            {
                $arret = Arret::find($idArret);
                $lat = $arret->latArret;
                $long = $arret->longArret;
                $nomArret = $arret->nomArret;
                if($lat != '0')
                {
                    array_push($results, ["Geometry" => ['Latitude' => $lat, 'Longitude' => $long, 'nomArret' => $nomArret]]);
                }
            }
            
            return Response::json($results);
        }
        else
        {
            return [];
        }
        
    }
    
    public static function updatePolys()
    {
        header('Access-Control-Allow-Origin: *'); 
        $idLigne = Input::get('idLigne');
        $sens = Input::get('sens');
        $polyline = Input::get('polyline');
        
    }
    
    public function generateLines()
    {
        return View::make('private.pages.generateLines');
    }
    
}