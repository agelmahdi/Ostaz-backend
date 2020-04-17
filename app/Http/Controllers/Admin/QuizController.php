<?php


namespace App\Http\Controllers\Admin;

use App\Category;
use App\Permissioncategory;
use App\Permission;
use App\Quiz;
use App\Streamer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:quiz-list');
        $this->middleware('permission:quiz-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:quiz-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:quiz-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quizzes =Quiz::orderBy('id', 'DESC')->get();
        return view('Admin.quizzes.index', compact('quizzes'))->with('i');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streamers=Streamer::get();
        return view('Admin.quizzes.create',compact('streamers'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'time' => 'required|integer',
            'lang' => 'required|string',
            'questions_number' => 'required|integer',
            'streamer_id' => 'required|integer',
        ]);
       $slug=$this->generateRandomString(10);
        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->slug = $slug;
        $quiz->time = $request->time;
        $quiz->lang = $request->lang;
        $quiz->questions_number = $request->questions_number;
        $quiz->streamer_id = $request->streamer_id;
        $quiz->save();
        return redirect()->route('Admin.quiz.index')->with('success', 'Quiz created successfully.');
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('Admin.quizzes.show', compact('quiz'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        $streamers=Streamer::get();
        return view('Admin.quizzes.edit', compact(['quiz','streamers']));
    }


    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $this->validate($request,[
            'title' => 'required',
            'time' => 'required|integer',
            'lang' => 'required|string',
            'questions_number' => 'required|integer',
            'streamer_id' => 'required|integer',
        ]);
        $quiz->title = $request->title;
        $quiz->time = $request->time;
        $quiz->lang = $request->lang;
        $quiz->questions_number = $request->questions_number;
        $quiz->streamer_id = $request->streamer_id;
        $quiz->save();
        return redirect()->route('Admin.quiz.index')->with('success', 'Quiz created successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quiz_id);
        $quiz->delete();
        return redirect()->back()->with('success', 'Quiz Deleted successfully.');
    }
}
