<?php

namespace App\Http\Controllers\Admin;

use App\Localization;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:localization-list');
        $this->middleware('permission:localization-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:localization-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:localization-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $localizations = Localization::orderBy('id', 'DESC')->get();
        return view('Admin.localizations.index', compact('localizations'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.localizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

            Localization::create($value);

        }

        $myfile = fopen("../resources/lang/en/main.php", "w") or die("Unable to open file!");

        $localizations = Localization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_en."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/main.php", "w") or die("Unable to open file!");

        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_ar."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.localization.index')
            ->with('success', 'Localization created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */

    public function edit(Localization $localization)
    {
        return view('Admin.localizations.edit', compact('localization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Localization $localization)
    {
        $request->validate([
            'addmore.*.key' => 'required',
            'addmore.*.value_en' => 'required',
            'addmore.*.value_ar' => 'required',

        ]);

        $localization->update($request->all());


        $myfile = fopen("../resources/lang/en/main.php", "w") or die("Unable to open file!");

        $localizations = Localization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_en."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/main.php", "w") or die("Unable to open file!");

        $localizations = Localization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_ar."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.localization.index')
            ->with('success', 'localization updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Localization  $localization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Localization $localization)
    {
        dd($localization->id);
        $localization->delete();

        $myfile = fopen("../resources/lang/en/main.php", "w") or die("Unable to open file!");

        $localizations = Localization::orderBy('key')->get();
        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_en."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
//        ------------------------------------------------------------
        $myfile = fopen("../resources/lang/ar/main.php", "w") or die("Unable to open file!");

        $txt = "<?php\nreturn [\n";
        fwrite($myfile, $txt);
        foreach($localizations as $localization){

            $txt = "'".$localization->key."' => '".$localization->value_ar."',\n";
            fwrite($myfile, $txt);

        }

        $txt = "];\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        return redirect()->route('Admin.localization.index')
            ->with('success', 'localization deleted successfully');
    }
}
