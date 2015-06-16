<?php

class HorairesController extends \BaseController{
    
    public function dispatchRequest()
    {
        if(Input::get('findLA'))
        {
            if(empty(Input::get('ligne')) && empty(Input::get('arret')))
            {
                Session::flash('flash_msg', "Vous n'avez pas sélectionné de ligne ou d'arrêt.");
                Session::flash('flash_type', "fail");
                return Redirect::to(URL::previous());
            }
            else
            {
                return $this->findByLigneArret();
            }
        }
        if(Input::get('findL'))
        {  
            if(empty(Input::get('ligne')))
            {
                Session::flash('flash_msg', "Vous n'avez pas sélectionné de ligne.");
                Session::flash('flash_type', "fail");
                return Redirect::to(URL::previous());
            }
            else
            {
                return $this->findByLigne();
            }
        }
        if(Input::get('findA'))
        {
            if(empty(Input::get('arret')))
            {
                Session::flash('flash_msg', "Vous n'avez pas sélectionné d'arrêt.");
                Session::flash('flash_type', "fail");
                return Redirect::to(URL::previous());
            }
            else
            {
                return $this->findByArret();
            }
        }
    }
    
    public function findByLigneArret($ligne = null, $arret = null, $date = null, $heureMin = null)
    {
        if (Request::isMethod('post'))
        {
            $ligne = (int)Input::get('ligne')[0];
            $date = Input::get('date');
            $selectedArret = trim(urldecode(strtoupper(Input::get('arret'))));
            $heure = Input::get('heure');
            $minute = Input::get('minute');
        }
        else{
            $selectedArret = strtoupper($arret);
            $heure = explode(':', $heureMin)[0];
            $minute = explode(':', $heureMin)[1];
        }
        

        $horaires = Horaire::getHorairesByLigne($ligne, $date, $heure, $minute);
        $nomLigne = Ligne::findNameById($ligne);
        $fichierPDF = Ligne::find($ligne)->fichierPDF;
        return View::make('public.pages.horairesLigne')
                        ->with('idLigne', $ligne)
                        ->with('fichierPDF', $fichierPDF)
                        ->with('nomLigne', $nomLigne)
                        ->with('selectedArret', $selectedArret)
                        ->with('heureMin', $heure . ':' . $minute)
                        ->with('horaires', $horaires)
                        ->with('date', $date);
        
    }
    
    
    public function findByLigne($ligne = null)
    {
        if(!isset($ligne)) $ligne = (int)Input::get('ligne')[0]; else $ligne = (int)$ligne;
        $heure = Input::get('heure');
        $minute = Input::get('minute');
        
        if(is_null(Input::get('date')))
            $date = date('d-m-Y');
        else 
            $date = Input::get('date');
        
        
        $horaires = Horaire::getHorairesByLigne($ligne, $date, $heure, $minute);
        $nomLigne = Ligne::findNameById($ligne);
        $fichierPDF = Ligne::find($ligne)->fichierPDF;
        
        return View::make('public.pages.horairesLigne')
                        ->with('idLigne', $ligne)
                        ->with('fichierPDF', $fichierPDF)
                        ->with('nomLigne', $nomLigne)
                        ->with('selectedArret', null)
                        ->with('heureMin', Input::get('heure') . ':' . Input::get('minute'))
                        ->with('horaires', $horaires)
                        ->with('heureMin', $heure . ':' . $minute)
                        ->with('date', $date);
    }
    
    public function findByArret()
    {
        $lignes = Horaire::findLignesByArret(Input::get('arret'));
                
        if(is_null(Input::get('date')))
            $date = date('d-m-Y');
        else 
            $date = Input::get('date');
            
        if(is_null(Input::get('heure')))
            $heure = '00';
        else 
            $heure = Input::get('heure');
            
        if(is_null(Input::get('minute')))
            $minute = '00';
        else 
            $minute = Input::get('minute');
            
        return View::make('public.pages.listeLignes')
            ->with('lignes', $lignes)
            ->with('date', $date)
            ->with('heureMin', $heure . ':' . $minute)
            ->with('arret', Input::get('arret'));
    }

    public function horaireGeneratePDF($idLigne)
    {

        $largeurNomArret = 35;
        $maxCourses = 15;
        $couleurPair = [236, 240, 241];
        $couleurImpair = [255, 255, 255];
        $couleurActuelle = 0;
        
        require public_path() . '/lib/fpdf/fpdf.php';
        $date = date('d-m-Y');
        $horaires = Horaire::getHorairesByLigne($idLigne, $date, '00', '00');
        $idSemaine = array_keys($horaires)[0];
        $arret = array_keys($horaires[$idSemaine]['aller'])[0];
        $courses = count($horaires[$idSemaine]['aller'][$arret]);
        $largeurCol = (277 - $largeurNomArret) / $courses;
        $count =0;
        

        $pdf = new FPDF('L');
        $pdf->SetTopMargin(5);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetFillColor($couleurImpair[0], $couleurImpair[1], $couleurImpair[2]);
        
        if($courses <= $maxCourses)
        {
            foreach($horaires[$idSemaine]['aller'] as $nomArret => $horaires)
            {
                $pdf->Cell($largeurNomArret, 6, $nomArret, 0, 0);
                
                foreach($horaires as $horaire)
                {
                    if($horaire == '00:00:00')
                        $pdf->Cell($largeurCol, 6, str_limit('', 5, $end = ''), 0, 0, 'C', true);
                    else
                        $pdf->Cell($largeurCol, 6, str_limit($horaire, 5, $end = ''), 0, 0, 'C', true);
                }
                
                $pdf->Ln();
                
                if($couleurActuelle){
                    $pdf->SetFillColor($couleurImpair[0], $couleurImpair[1], $couleurImpair[2]);
                    $couleurActuelle = 0;
                }
                else{
                    $pdf->SetFillColor($couleurPair[0], $couleurPair[1], $couleurPair[2]);
                    $couleurActuelle = 1;
                }
                    
            }
            
        }
        else
        {
            $largeurCol = (277 - $largeurNomArret) / (round($courses/2));
            foreach($horaires[$idSemaine]['aller'] as $nomArret => $horairesArret)
            {

                $pdf->Cell($largeurNomArret, 5, $nomArret, 0, 0);
                
                for($i = 0; $i < $courses/2; $i++)
                {
                    if($horairesArret[$i] == '00:00:00')
                        $pdf->Cell($largeurCol, 5, str_limit('', 5, $end = ''), 0, 0, 'C', true);
                    else
                        $pdf->Cell($largeurCol, 5, str_limit($horairesArret[$i], 5, $end = ''), 0, 0, 'C', true);
                }
                
                $pdf->Ln();
                
                if($couleurActuelle){
                    $pdf->SetFillColor($couleurImpair[0], $couleurImpair[1], $couleurImpair[2]);
                    $couleurActuelle = 0;
                }
                else{
                    $pdf->SetFillColor($couleurPair[0], $couleurPair[1], $couleurPair[2]);
                    $couleurActuelle = 1;
                }
                
            }
            
            $pdf->AddPage();
            
            
            foreach($horaires[$idSemaine]['aller'] as $nomArret => $horairesArret)
            {

                $pdf->Cell($largeurNomArret, 5, $nomArret, 0, 0);
                
                for($i = ($courses/2 + 1); $i < $courses; $i++)
                {
                    if($horairesArret[$i] == '00:00:00')
                        $pdf->Cell($largeurCol, 5, str_limit('', 5, $end = ''), 0, 0, 'C', true);
                    else
                        $pdf->Cell($largeurCol, 5, str_limit($horairesArret[$i], 5, $end = ''), 0, 0, 'C', true);
                }
                
                $pdf->Ln();
                
                if($couleurActuelle){
                    $pdf->SetFillColor($couleurImpair[0], $couleurImpair[1], $couleurImpair[2]);
                    $couleurActuelle = 0;
                }
                else{
                    $pdf->SetFillColor($couleurPair[0], $couleurPair[1], $couleurPair[2]);
                    $couleurActuelle = 1;
                }
                
            }
        }
        
        
        
        // dd($largeurCol);
        
        // dd($courses);
        
        
        
        return Response::make($pdf->Output())->header('Content-Type', 'application/pdf');
        
    }
}