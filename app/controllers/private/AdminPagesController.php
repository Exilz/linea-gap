<?php

class AdminPagesController extends \BaseController{
    
    public function pages()
    {
        $pages = Page::all();
        return View::make('private.pages.pages')->with('pages', $pages);
    }
    
    public function newPage()
    {
        return View::make('private.forms.newPage');
    }
    
    public function editPage($id)
    {
        $page = Page::find($id);
        return View::make('private.forms.updatePage')->with('page', $page);
    }
    
    public function deletePage($id)
    {
        $page = Page::find($id);
        Page::destroy($id);
        
        Session::flash('flash_msg', "La page " . $page->titrePage . " a bien été supprimée.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/pages');
    }
    
    public function storePage()
    {
        $page = new Page;
        
        $input = [
                    "titrePage"         => Input::get('titrePage'),
                    "titreLien"         => Input::get('titreLien'),
                    "submenu"           => Input::get('submenu'),
                    "contenu"           => Input::get('contenu'),
                    "slug"              => Str::slug(Input::get('titreLien'))
                 ];
                 
        $rules = array(
            'titrePage'             => 'required',
            'titreLien'             => 'required|max:255',
            'submenu'               => 'required|integer',
            'contenu'               => 'required'
        );

        
        $messages = array(
                            'required'  => ":attribute est requis pour l'ajout d'une nouvelle page.",
                            'max'       => "Le titre du lien est trop long.",
                            'integer'   => "Sous-menu selectionné incorrect"
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "La nouvelle page a bien été ajoutée.");
            Session::flash('flash_type', "success");
            $page->fill($input)->save();
            return Redirect::to("/admin/pages/");
        }
    }
    
    public function updatePage($id)
    {
        $page = Page::find($id);
        

        $input = [
                    "titrePage"         => Input::get('titrePage'),
                    "titreLien"         => Input::get('titreLien'),
                    "submenu"           => Input::get('submenu'),
                    "contenu"           => Input::get('contenu'),
                    "slug"              => Str::slug(Input::get('titreLien'))
                 ];
        
                 
        $rules = array(
            'titrePage'             => 'required',
            'titreLien'             => 'required|max:255',
            'submenu'               => 'required|integer',
            'contenu'               => 'required'
        );

        $messages = array(
                            'required'  => ":attribute est requis pour la modification d'une page.",
                            'max'       => "Le titre du lien est trop long.",
                            'integer'   => "Sous-menu selectionné incorrect"
                         );
        
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "La page {$input['titrePage']} a bien été modifiée.");
            Session::flash('flash_type', "success");
            $page->fill($input)->save();
            return Redirect::to("/admin/pages/$id");
        }
    }
    
}