<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Lesson;
use App\Quiz;
use App\Category;
use App\Word;

class QuizController extends Controller
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
        $category = Category::findOrFail($category_id);

        return view('quizzes.index', compact('category', 'lesson'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $category = Category::findOrFail($category_id);
        $questions = $category->questions()->paginate(1);
        if(empty($category->checkIfTakenCategory($category_id, auth()->user()->id)->get()[0]->id))
            $lesson = $this->setTakenCategory($category_id); 
        else
            $lesson = $category->checkIfTakenCategory($category_id, auth()->user()->id)->get()[0]->id;

        return view('quizzes.answer', compact('category', 'questions', 'lesson')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setTakenCategory($category_id)
    {
        return Lesson::create([
            'category_id' => $category_id,
            'user_id' => auth()->user()->id
        ]);
    }

    public function setAnswer($category_id, $lesson_id, $question_id, $page, Request $request)
    {
        $questions = Question::where('category_id', $category_id)->get();
        $word = Word::findOrFail($question_id);
        $choice = $request->answer;
        $answer = $request->$choice;
        $result = $word->isCorrect($answer)->get()[0]->is_correct;
        Quiz::create([
            'lesson_id' => $lesson_id,
            'question_id' => $question_id,
            'answer' => $answer,
            'is_correct' => $result
        ]);
        ++$page;

        if(count($questions) < $page)
            return redirect()->route('categories.index');
        else
            return redirect('categories/'. $category_id . '/quizzes/' . $category_id . '?page=' . $page);
    }

    public function displayResults($category_id)
    {
        $category = Category::findOrFail($category_id);
        $lesson = Lesson::where('category_id', $category_id)
                        ->where('user_id', auth()->user()->id)->get()[0];
        $questions = $category->questions()->get();

        return view('quizzes.result', compact('category','questions', 'lesson'));  
    }
}
