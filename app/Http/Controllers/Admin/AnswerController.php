<?php

namespace App\Http\Controllers\Admin;


use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:questions-list');
        $this->middleware('permission:questions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:questions-edit', ['only' => ['edit', 'update','changeStatus']]);
        $this->middleware('permission:questions-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {

        $answers=Answer::where('question_id',$question->id)->get();
        return view('Admin.answers.index', compact(['answers','question']))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question)
    {
        return view('Admin.answers.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$question)
    {
        $request->validate([
            'addmore.*.title' => 'required',

        ]);

        foreach ($request->addmore as $key => $value) {
            Answer::create([
                'question_id' => $question,
                'title' => $value['title'],
                'right' => 0,
            ]);
        }

        return redirect()->route('Admin.answer.index',$question)
            ->with('success', 'Answer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        dd('1');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('Admin.questions.edit', compact(['question']));
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
        $this->validate($request,[
            'title' => 'required',
        ]);
        $question->title = $request->title;
        $question->save();
        return redirect()->route('Admin.question.index',$question->quiz_id)->with('success', 'Question created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request->question_id);
        $question = Question::findOrFail($request->question_id);
        $question->delete();
        return redirect()->back()->with('success', 'Question Deleted successfully.');
    }
    public function changeStatus(Request $request)
    {
//        dd('yes');
        $answer = Answer::find($request->id);
        $answer->right = $request->right;
        $answer->save();

        return response()->json(['success'=>'Answer change successfully.']);
    }
}
