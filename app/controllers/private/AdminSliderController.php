<?php

class AdminSliderController extends \BaseController {
 
    public function slider()
    {
        $slides = Slider::orderBy('pos')->get();
        
        return View::make('private.pages.slider')
                        ->with('slides', $slides);
    }

    public function updatePos()
    {
        $order = Input::get('order');
        
        foreach($order as $id => $pos)
        {
            $slide = Slider::find($id);
            $slide->pos = $pos;
            $slide->save();
        }
    }
    
    public function updateValues()
    {
        $slide = Slider::find(Input::get('id'));
        $slide->nom = Input::get('nom');
        $slide->alt = Input::get('alt');
        $slide->save();
    }
    
    public function deleteSlide()
    {
        $slide = Slider::find(Input::get('id'));
        if(is_file(public_path() . '/uploads/slider/' . $slide->link))
        {
            unlink(public_path() . '/uploads/slider/' . $slide->link);
        }
        
        Slider::destroy(Input::get('id'));
    }
    
    public function storeSlider()
    {
        $slide = new Slider;
        
        $input = [
                    "nom"       => Input::get('nom'),
                    "alt"       => Input::get('alt')
                 ];

        $rules = array(
                    'nom'           => 'required|max:255',
                    'alt'           => 'required|max:255' 
        );
        
        $messages = array(
                            'required'          => ":attribute est requis pour l'ajout d'une nouvelle image au carousel.",
                            'max'            => ':attribute est trop long.'
                         );

        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            
            $uploadedImage = Input::file('image');
            
            // Création d'un nom aléatoire pour l'enregistrement
            $fileName = md5(time() + rand(0, 1000)) . '.jpg';
            $savePath = public_path() . '/uploads/slider/';

            
            
            $extension = strtolower($uploadedImage->getClientOriginalExtension());
            
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png")
            {
                
                // Si on a choisi de rendimensionner
                if(Input::get('resample') != null)
                {
                    // Récupération de la taille de l'image envoyée
                    list($uploadedWidth, $uploadedHeight) = getimagesize($uploadedImage);
                    
                    // Nouvelles dimensions
                    $newWidth = 1165;
                    $newHeight = 350;
                    
                    // Création d'une nouvelle image vide et sample de l'image envoyée
                    $newImage = imagecreatetruecolor($newWidth, $newHeight);
                    
                    if($extension == "jpg" || $extension == "jpeg")
                    {
                        $uploadedImageSample = imagecreatefromjpeg($uploadedImage);
                    }
                    else
                    {
                        $uploadedImageSample = imagecreatefrompng($uploadedImage);
                    }
                    
                    // Rendimensionnement et enregistrement de la nouvelle image
                    imagecopyresampled($newImage, $uploadedImageSample, 0, 0, 0, 0, $newWidth, $newHeight, $uploadedWidth, $uploadedHeight);
                    imagejpeg($newImage, $savePath . $fileName, 100);
                }
                // Pas de redimensionnement
                else
                {
                    $uploadedImage->move($savePath, $fileName);
                }
                
                // Lien en BDD et position (max+1)
                $input['link'] = $fileName;
                $input['pos'] = Slider::get()->max('pos')+1;
                
                Session::flash('flash_msg', "La nouvelle image a bien été ajoutée.");
                Session::flash('flash_type', "success");
                $slide->fill($input)->save();
                return Redirect::to("/admin/slider");
                
            }
            else
            {
                Session::flash('flash_msg', "Le fichier importé n'est pas valide (jpeg ou png uniquement).");
                Session::flash('flash_type', "fail");
                return Redirect::to("/admin/slider");    
            }

            
        }
    }
    
    
}