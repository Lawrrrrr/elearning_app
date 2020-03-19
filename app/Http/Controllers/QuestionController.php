<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Word;
use App\Category;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $category = Category::find($category_id);
        if(!empty($category))
            $questions = $category->questions()->get();

        return view('questions.index', compact('category', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($category_id)
    {
        $category = Category::find($category_id);

        return view('questions.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $request->validate([
            "title" => "required|min:2",
            "choice1" => "required|min:2",
            "choice2" => "required|min:2",
            "choice3" => "required|min:2",
            "choice4" => "required|min:2",
            "answer" => "required"
        ]);

        $question = Question::create([
            "category_id" => $id,
            "title" => $request->title
        ]);

        $this->storeWords($question->id, $request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category_id, $question_id)
    {
        $category = Category::find($category_id);
        $question = Question::find($question_id);
        $words = $question->words()->get();

        return view('questions.edit', compact('words', 'question', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id, $question_id)
    {
        $request->validate([
            "title" => "required|min:2",
            "choice1" => "required|min:2",
            "choice2" => "required|min:2",
            "choice3" => "required|min:2",
            "choice4" => "required|min:2",
            "answer" => "required"
        ]);

        $question = Question::find($question_id);
        $words = $question->words()->get();
        $this->resetIsCorrect($words);
        $index = 1; 
        foreach($words as $word) {
            $choice = "choice" . $index;
            $word->update([
                "option" => $request->$choice,
                "is_correct" => $request->answer == $choice ? 1 : 0
            ]);
            $index++;
        }

        return redirect()->route('categories.questions.index', $category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id, $question_id)
    {
        Question::find($question_id)->delete();

        return redirect()->route('categories.questions.index', $category_id);
    }

    public function storeWords($id, $request)
    {
        for ($i = 1; $i < 5; $i++) {
            $choice = "choice" . $i;
            Word::create([
                "question_id" => $id,
                "option" => $request->$choice,
                "is_correct" => $request->answer == $choice ? 1 : 0
            ]);
        }
    }

    public function resetIsCorrect($words)
    {
        foreach ($words as $word) {
            $word->update([
                "is_correct" => 0
            ]);
        }
    }
}
