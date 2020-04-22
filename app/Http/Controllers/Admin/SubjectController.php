<?php


namespace App\Http\Controllers\Admin;

use App\Subject;
use App\Streamer;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:subject-list');
        $this->middleware('permission:subject-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subject-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subject-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::latest()->get();
        return view('Admin.subjects.index', compact('subjects'))->with('i');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $streamers=Streamer::get();
        return view('Admin.subjects.create',compact('streamers'));
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'slug_ar' => 'required|unique:academic_years,slug_ar',
            'slug_en' => 'required|unique:academic_years,slug_en',
        ]);
        $Subject = new Subject();
        $Subject->title_ar = $request->title_ar;
        $Subject->title_en = $request->title_en;
        $Subject->slug_ar = $request->slug_ar;
        $Subject->slug_en = $request->slug_en;
        $Subject->save();
        $Subject->streamers()->attach($request->streamers);
        return redirect()->route('Admin.subject.index')->with('success', 'Subject created successfully.');
    }
    public function edit(Subject $subject)
    {
        $streamers=Streamer::get();
        return view('Admin.subjects.edit',compact('subject','streamers'));
    }
    public function update(Request $request, Subject $Subject)
    {
        $this->validate($request,[
            'title_ar' => 'required',
            'title_en' => 'required',
            'slug_ar' => 'required|unique:subjects,slug_ar,'.$Subject->id,
            'slug_en' => 'required|unique:subjects,slug_en,'.$Subject->id,
        ]);
        $Subject->title_ar = $request->title_ar;
        $Subject->title_en = $request->title_en;
        $Subject->slug_ar = $request->slug_ar;
        $Subject->slug_en = $request->slug_en;
        $Subject->save();
        $Subject->streamers()->sync($request->streamers);
        return redirect()->route('Admin.subject.index')->with('success', 'Subject Updated successfully.');
    }
    public function destroy(Request $request)
    {
        $Subject = Subject::findOrFail($request->subject_id);
        $Subject->delete();
        $Subject->streamers()->detach();
        return redirect()->back()->with('success', 'Subject Deleted successfully.');
    }


}
