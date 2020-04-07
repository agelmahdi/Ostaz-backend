<?php


namespace App\Http\Controllers\Admin;
use App\Option;
use Illuminate\Http\Request;


class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:option-list');
        $this->middleware('permission:option-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:option-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:option-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $options = Option::orderBy('id', 'DESC')->get();
        return view('Admin.options.index', compact('options'))->with('i');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.options.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'addmore.*.key' => 'required',
            'addmore.*.value' => 'required',

        ]);

        foreach ($request->addmore as $key => $value) {

            Option::create($value);

        }

        return redirect()->route('Admin.options.index')
            ->with('success', 'Options created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return view('Admin.options.show', compact('option'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return view('Admin.options.edit', compact('option'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        request()->validate([
            'key' => 'required',
            'value' => 'required',
        ]);

        $option->update($request->all());
        return redirect()->route('Admin.options.index')
            ->with('success', 'Option updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Option $option)
    {
        $option->delete();


        return redirect()->route('Admin.options.index')
            ->with('success', 'Option deleted successfully');
    }
}
