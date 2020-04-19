<?php


namespace App\Http\Controllers\Admin;

use App\AcademicYear;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:academic_year-list');
        $this->middleware('permission:academic_year-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:academic_year-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:academic_year-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $academics = AcademicYear::latest()->get();
        return view('Admin.academicYears.index', compact('academics'))->with('i');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.academicYears.create');
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
        $academicyear = new AcademicYear();
        $academicyear->title_ar = $request->title_ar;
        $academicyear->title_en = $request->title_en;
        $academicyear->slug_ar = $request->slug_ar;
        $academicyear->slug_en = $request->slug_en;
        $academicyear->save();

        return redirect()->route('Admin.academicyears.index')->with('success', 'AcademicYear created successfully.');
    }
    public function edit(AcademicYear $academicyear)
    {
        return view('Admin.academicYears.edit',compact('academicyear'));
    }
    public function update(Request $request, AcademicYear $academicyear)
    {
        $this->validate($request,[
            'title_ar' => 'required',
            'title_en' => 'required',
            'slug_ar' => 'required|unique:academic_years,slug_ar,'.$academicyear->id,
            'slug_en' => 'required|unique:academic_years,slug_en,'.$academicyear->id,
        ]);
        $academicyear->title_ar = $request->title_ar;
        $academicyear->title_en = $request->title_en;
        $academicyear->slug_ar = $request->slug_ar;
        $academicyear->slug_en = $request->slug_en;
        $academicyear->save();

        return redirect()->route('Admin.academicyears.index')->with('success', 'AcademicYear Updated successfully.');
    }
    public function destroy(Request $request)
    {
        $academicyear = AcademicYear::findOrFail($request->academicyear_id);
        $academicyear->delete();
        return redirect()->back()->with('success', 'AcademicYear Deleted successfully.');
    }


}
