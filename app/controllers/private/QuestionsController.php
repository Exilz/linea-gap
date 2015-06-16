<?php

class QuestionsController extends \BaseController{
    
    public function questions()
    {
        $questionsNonLues = Question::where('lue', '=', '0')->get();
        $questionsLues = Question::where('lue', '=', '1')->get();
        
        $countNonLues = $questionsNonLues->count();
        $countLues = $questionsLues->count();
        
        
        return View::make('private.pages.questions')
            ->with('countNonLues', $countNonLues)
            ->with('countLues', $countLues)
            ->with('questionsNonLues', $questionsNonLues)
            ->with('questionsLues', $questionsLues);
    }
    
    public function answerQuestions($id)
    {
        $question = Question::find($id);
        return View::make('private.forms.answerQuestion')->with('question', $question);
    }
    
    public function markAsRead($id)
    {
        $question = Question::find($id);
        $question->lue = '1';
        $question->save();
        Session::flash('flash_msg', "Question n° " . $question->idQuestion . " marquée comme traitée.");
        Session::flash('flash_type', "success");
        return Redirect::to('/admin/questions');
    }
    
    public function deleteQuestions($id)
    {
        $question = Question::find($id);
        Question::destroy($id);
        
        Session::flash('flash_msg', "La question N° " . $question->idQuestion . " a bien été supprimée.");
        Session::flash('flash_type', "success");
        
        return Redirect::to('/admin/questions');
    }
    
}