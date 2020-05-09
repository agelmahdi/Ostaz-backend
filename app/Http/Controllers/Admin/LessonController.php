<?php


namespace App\Http\Controllers\Admin;

use App\AcademicYear;
use App\Category;
use App\Group;
use App\Lesson;
use App\Permissioncategory;
use App\Permission;
use App\Quiz;
use App\Streamer;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   function __construct()
   {
       $this->middleware('permission:lesson-list');
       $this->middleware('permission:lesson-create', ['only' => ['create', 'store']]);
       $this->middleware('permission:lesson-edit', ['only' => ['edit', 'update']]);
       $this->middleware('permission:lesson-delete', ['only' => ['destroy']]);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons =Lesson::orderBy('id', 'DESC')->get();
        return view('Admin.lessons.index', compact('lessons'))->with('i');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups=Group::get();
        return view('Admin.lessons.create',compact('groups'));
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
            'slug' => 'required|unique:lessons,slug',
            'description' => 'required', 
            'start' => 'required',
            'end' => 'required',
            'group_id' => 'required|integer',
        ]);
        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->description = $request->description;
        $lesson->start = $request->start;
        $lesson->end = $request->end;
        $lesson->group_id = $request->group_id;
        $lesson->save();
        return redirect()->route('Admin.lesson.index')->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $group)
    {
        return view('Admin.quizzes.show', compact('group'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {

        $groups=Group::get();
        return view('Admin.lessons.edit', compact(['lesson','groups']));
    }


    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Quiz $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required|unique:lessons,slug,'.$lesson->id,
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'group_id' => 'required|integer',
        ]);
        $lesson = new Lesson();
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->description = $request->description;
        $lesson->start = $request->start;
        $lesson->end = $request->end;
        $lesson->group_id = $request->group_id;
        $lesson->save();
        return redirect()->route('Admin.lesson.index')->with('success', 'Lesson created successfully.');
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
        $group = Lesson::findOrFail($request->group_id);
        $group->delete();
        return redirect()->back()->with('success', 'group Deleted successfully.');
    }
}
