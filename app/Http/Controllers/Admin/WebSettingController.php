<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Option;
class WebSettingController extends Controller
{

    public function index()
    {
        return view('Admin.websetting.index');
    }


    public function update(Request $request, Option $option)
    {
        option(["Website_Name_En" => $request->Website_Name_En]);
        option(["Website_Name_Ar" => $request->Website_Name_Ar]);
        return redirect()->route('Admin.websetting.index')->with('success', 'web setting Updated successfully.');
    }

}
