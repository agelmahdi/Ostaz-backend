<?php


namespace App\Http\Controllers\Admin;


use App\Permissioncategory;
use Illuminate\Http\Request;


class PermissioncategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {    $this->middleware('permission:permissioncategory-list');
         $this->middleware('permission:permissioncategory-create', ['only' => ['create','store']]);
         $this->middleware('permission:permissioncategory-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permissioncategory-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissioncategories = Permissioncategory::orderBy('id','DESC')->get();
        return view('Admin.permissioncategories.index',compact('permissioncategories')) ->with('i');;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.permissioncategories.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);


        Permissioncategory::create($request->all());

        $request->guard_name='web';
        return redirect()->route('Admin.permissioncategories.index')
                        ->with('success','Permissioncategory created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Permissioncategory  $permissioncategory
     * @return \Illuminate\Http\Response
     */
    public function show(Permissioncategory $permissioncategory)
    {
        return view('Admin.permissioncategories.show',compact('permissioncategory'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissioncategory  $permissioncategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissioncategory $permissioncategory)
    {
        return view('Admin.permissioncategories.edit',compact('permissioncategory'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permissioncategory  $permissioncategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permissioncategory $permissioncategory)
    {
         request()->validate([
            'name' => 'required',
        ]);


        $permissioncategory->update($request->all());
        $request->guard_name='web';
        return redirect()->route('Admin.permissioncategories.index')
                        ->with('success','Permissioncategory updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permissioncategory  $permissioncategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissioncategory $permissioncategory)
    {
        $permissioncategory->delete();


        return redirect()->route('Admin.permissioncategories.index')
                        ->with('success','Permissioncategory deleted successfully');
    }
}
