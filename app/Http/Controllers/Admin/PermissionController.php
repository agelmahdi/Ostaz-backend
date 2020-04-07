<?php


namespace App\Http\Controllers\Admin;

use App\Permissioncategory;
use App\Permission;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:permission-list');
        $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::orderBy('id', 'DESC')->get();
        return view('Admin.permissions.index', compact('permissions'))->with('i');;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.permissions.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        request()->validate([
//            'name' => 'required',
//        ]);
//
//        $category_name = mb_split("-", $request->name);
//        $permissionCategory = new PermissionCategory();
//        $permissionCategory->name = $category_name[0];
//        $categories_count = PermissionCategory::where('name', '=', $category_name[0])->count();
//        if ($categories_count == 0) {
//
//            $permissionCategory->save();
//        }
//        Permission::create($request->all());
//        $request->guard_name = 'web';
//        return redirect()->route('Admin.permissions.index')
//            ->with('success', 'Permission created successfully.');
        $request->validate([
            'addmore.*.name' => 'required',

        ]);

        foreach ($request->addmore as $key => $value) {

            Permission::create($value);
            $category_name = mb_split("-", $value['name']);
            $permissionCategory = new PermissionCategory();
            $permissionCategory->name = $category_name[0];
            $categories_count = PermissionCategory::where('name', '=', $category_name[0])->count();
            if ($categories_count == 0) {

                $permissionCategory->save();
            }
        }

        return redirect()->route('Admin.permissions.index')
            ->with('success', 'Permission created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('Admin.permissions.show', compact('permission'));
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
    public function destroy(Permission $permission)
    {
        $permission->delete();


        return redirect()->route('Admin.permissions.index')
            ->with('success', 'Permission deleted successfully');
    }
}
