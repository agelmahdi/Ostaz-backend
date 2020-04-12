<?php

namespace App\Http\Controllers\Admin;


use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:questions-list');
        $this->middleware('permission:questions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:questions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:questions-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Quiz $quiz)
    {

      $questions=Question::where('quiz_id',$quiz->id)->get();
        return view('Admin.questions.index', compact(['quiz','questions']))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz)
    {
        return view('Admin.questions.create',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$quiz)
    {
        $request->validate([
            'addmore.*.title' => 'required',

        ]);

        foreach ($request->addmore as $key => $value) {
            Question::create([
                'quiz_id' => $quiz,
                'title' => $value['title'],
            ]);
        }

        return redirect()->route('Admin.question.index',$quiz)
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
