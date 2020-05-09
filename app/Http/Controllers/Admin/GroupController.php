<?php


namespace App\Http\Controllers\Admin;

use App\AcademicYear;
use App\Category;
use App\Group;
use App\Permissioncategory;
use App\Permission;
use App\Quiz;
use App\Streamer;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   function __construct()
   {
       $this->middleware('permission:group-list');
       $this->middleware('permission:group-create', ['only' => ['create', 'store']]);
       $this->middleware('permission:group-edit', ['only' => ['edit', 'update']]);
       $this->middleware('permission:group-delete', ['only' => ['destroy']]);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups =Group::orderBy('id', 'DESC')->get();
        return view('Admin.groups.index', compact('groups'))->with('i');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streamers=Streamer::get();
        $academic_years=AcademicYear::get();
        $subjects=Subject::get();
        return view('Admin.groups.create',compact('streamers','academic_years','subjects'));
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
            'slug' => 'required|unique:groups,slug,NULL,id,streamer_id,'.$request->streamer_id,
            'description' => 'required', 
            'start' => 'required',
            'end' => 'required',
            'streamer_id' => 'required|integer',
            'academic_year_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);
//        $streamer=Streamer::findOrFail($request->streamer_id);
        $group = new Group();
        $group->title = $request->title;
        $group->slug = $request->slug;
        $group->description = $request->description;
        $group->start = $request->start;
        $group->end = $request->end;
        $group->streamer_id = $request->streamer_id;
        $group->academic_year_id = $request->academic_year_id;
        $group->subject_id = $request->subject_id;
        $group->save();
        return redirect()->route('Admin.group.index')->with('success', 'Group created successfully.');
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
    public function edit(Group $group)
    {
        
        $streamers=Streamer::get();
        $academic_years=AcademicYear::get();
        $subjects=Subject::get();
        return view('Admin.groups.edit', compact(['group','streamers','academic_years','subjects']));
    }


    /**
     * Update the specified resource in storage.
     * @param \Illuminate\Http\Request $request
     * @param \App\Quiz $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required|unique:groups,slug'.$group->id,
            'description' => 'required', 
            'start' => 'required',
            'end' => 'required',
            'streamer_id' => 'required|integer',
            'academic_year_id' => 'required|integer',
            'subject_id' => 'required|integer',
        ]);
        $group->title = $request->title;
        $group->slug = $request->slug;
        $group->time = $request->time;
        $group->lang = $request->lang;
        $group->questions_number = $request->questions_number;
        $group->streamer_id = $request->streamer_id;
        $group->save();
        return redirect()->route('Admin.group.index')->with('success', 'group created successfully.');
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
        $group = Group::findOrFail($request->group_id);
        $group->delete();
        return redirect()->back()->with('success', 'group Deleted successfully.');
    }
}
