<?php

class AdminFaqController extends \BaseController{
    
    function faq()
    {
        $faq = Faq::all();
        return View::make('private.pages.faq')->with('faq', $faq);
    }
    
    public function editQuestion($id)
    {
        $question = Faq::find($id);
        return View::make('private.forms.updateQuestion')->with('question', $question);
    }
    
    public function newQuestion()
    {
        return View::make('private.forms.newQuestion');
    }
    
    public function updateQuestion($id)
    {
        
        $question = Faq::find($id);
        
        $input = [
                    "question"      => Input::get('question'),
                    "reponse"       => Input::get('reponse'),
                 ];
                 
        $rules = array(
            'question'          => 'required',
            'reponse'           => 'required'
        );
        
        $messages = array('required' => ':attribute est requis pour la modification');
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "La question n°" . $question->idFAQ . " a bien été modifiée.");
            Session::flash('flash_type', "success");
            $question->fill($input)->save();
            return Redirect::to(URL::previous());
        }
    }
    
    public function storeQuestion()
    {
        $question = new Faq;
        
        $input = [
                    "question"      => Input::get('question'),
                    "reponse"       => Input::get('reponse')
                 ];
                 
        $rules = array(
            'question'          => 'required',
            'reponse'           => 'required'
        );
        
        $messages = array('required' => ":attribute est requis pour l'ajout d'une nouvelle question.");
        
        $validator = Validator::make(Input::all(), $rules, $messages);
    
        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to(URL::previous())->withErrors($validator);
        }
        else
        {
            Session::flash('flash_msg', "La nouvelle réponse a bien été ajoutée.");
            Session::flash('flash_type', "success");
            $question->fill($input)->save();
            return Redirect::to("/admin/faq");
        }
    }
    
    public function deleteQuestion($id)
    {
        $question = Faq::find($id);
        Faq::destroy($id);
        
        Session::flash('flash_msg', "La question " . $question->idFAQ . " a bien été supprimée.");
        Session::flash('flash_type', "warning");
        
        return Redirect::to('/admin/faq');
    }
    
}