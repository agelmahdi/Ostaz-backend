<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\SubCategory;
use App\Category;

class SubCategoryController extends Controller
{
    function __construct()
    {    $this->middleware('permission:subcategory-list');
        $this->middleware('permission:subcategory-create', ['only' => ['create','store']]);
        $this->middleware('permission:subcategory-showdetails', ['only' => ['show']]);
        $this->middleware('permission:subcategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subcategory-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('Admin.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Admin.subcategory.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title_ar' => 'required',
            'title_en' => 'required',
            'categories' => 'required',
            'image' => 'required',
            'details_ar' => 'required',
            'details_en' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title_en);
        if(isset($image))
        {
//            make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('subcategory'))
            {
                Storage::disk('public')->makeDirectory('subcategory');
            }

            $subcategoryImage = Image::make($image)->resize(1600,1066)->save('test.jpg');
            Storage::disk('public')->put('subcategory/'.$imageName,$subcategoryImage);

        } else {
            $imageName = "default.png";
        }
        $subcategory = new SubCategory();
        $subcategory->title_ar = $request->title_ar;
        $subcategory->title_en = $request->title_en;
        $subcategory->slug = $slug;
        $subcategory->image = $imageName;
        $subcategory->details_ar = $request->details_ar;
        $subcategory->details_en = $request->details_en;
        $subcategory->category_id = $request->categories;
        $subcategory->save();
        return redirect()->route('Admin.subcategory.index')->with('success', ' SubCategory Saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subcategory)
    {

        $subcategory = SubCategory::find($subcategory);
        return view('Admin.subcategory.show',compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subcategory)
    {
        $categories = Category::all();
        return view('Admin.subcategory.edit',compact('subcategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subcategory)
    {
        $this->validate($request,[
            'title_ar' => 'required',
            'title_en' => 'required',
            'categories' => 'required',
            'image' => 'image',
            'details_ar' => 'required',
            'details_en' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title_en);
        if(isset($image))
        {
            // make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('subcategory'))
            {
                Storage::disk('public')->makeDirectory('subcategory');
            }

            // delete old post image
            if(Storage::disk('public')->exists('subcategory/'.$subcategory->image))
            {
                Storage::disk('public')->delete('subcategory/'.$subcategory->image);
            }
            $subcategoryImage = Image::make($image)->resize(1600,1066)->save('test.jpg');
            Storage::disk('public')->put('subcategory/'.$imageName,$subcategoryImage);

        } else {
            $imageName = $subcategory->image;
        }
        $subcategory->title_ar = $request->title_ar;
        $subcategory->title_en = $request->title_en;
        $subcategory->slug = $slug;
        $subcategory->image = $imageName;
        $subcategory->category_id = $request->categories;
        $subcategory->details_ar = $request->details_ar;
        $subcategory->details_en = $request->details_en;

        $subcategory->save();
        return redirect()->route('Admin.subcategory.index')->with('success', ' SubCategory Updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subCategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $subcategory = SubCategory::findOrFail($request->subcategory_id);

        if (Storage::disk('public')->exists('subcategory/'.$subcategory->image))
        {
            Storage::disk('public')->delete('subcategory/'.$subcategory->image);
        }
        $subcategory->delete();
        return redirect()->back()->with('success', ' SubCategory Deleted successfully.');
    }



}
