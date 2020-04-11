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
       $slug=md5(now());
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


    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('Admin.quiz.show', compact('quiz'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('Admin.permissions.edit', compact('permission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $category_name = mb_split("-", $request->name);
        $permissionCategory = new PermissionCategory();
        $permissionCategory->name = $category_name[0];
        $categories_count = PermissionCategory::where('name', '=', $category_name[0])->count();
        if ($categories_count == 0) {

            $permissionCategory->save();
        }
        $permission->update($request->all());
        $request->guard_name = 'web';
        return redirect()->route('Admin.permissions.index')
            ->with('success', 'Permission updated successfully');
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
