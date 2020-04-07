<?php

namespace App\Http\Controllers\Admin;

use App\adminLocalization;
use Illuminate\Http\Request;

class AdminLocalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:adminlocalization-list');
        $this->middleware('permission:adminlocalization-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:adminlocalization-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:adminlocalization-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $adminlocalizations = adminLocalization::orderBy('id', 'DESC')->get();
        return view('Admin.adminlocalizations.index', compact('adminlocalizations'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.adminlocalizations.create');
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
            'addmore.*.value_en' => 'required',
            'addmore.*.value_ar' => 'required',

        ]);

        foreach ($request->addmore as $key => $value) {

            adminLocalization::create($value);

        }

        $myfile = fopen("../resources/lang/en/admin.php", "w") or die("Unable to open file!");

        $adminlocalizations = adminLocalization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_en . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/admin.php", "w") or die("Unable to open file!");

        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_ar . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.adminlocalization.index')
            ->with('success', 'Localization created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Localization $localization
     * @return \Illuminate\Http\Response
     */

    public function edit(AdminLocalization $adminlocalization)
    {
        return view('Admin.adminlocalizations.edit', compact('adminlocalization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Localization $localization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminLocalization $adminlocalization)
    {
        $request->validate([
            'addmore.*.key' => 'required',
            'addmore.*.value_en' => 'required',
            'addmore.*.value_ar' => 'required',

        ]);

        $adminlocalization->update($request->all());


        $myfile = fopen("../resources/lang/en/admin.php", "w") or die("Unable to open file!");

        $adminlocalizations = adminLocalization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_en . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/admin.php", "w") or die("Unable to open file!");

        $adminlocalizations = adminLocalization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_ar . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.adminlocalization.index')
            ->with('success', 'localization updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Localization $localization
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminLocalization $adminlocalization)
    {
        $adminlocalization->delete();

        $myfile = fopen("../resources/lang/en/admin.php", "w") or die("Unable to open file!");

        $adminlocalizations = adminLocalization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_en . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/admin.php", "w") or die("Unable to open file!");

        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach ($adminlocalizations as $localization) {

            $txt = "'" . $localization->key . "' => '" . $localization->value_ar . "',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.adminlocalization.index')
            ->with('success', 'localization deleted successfully');
    }

}
