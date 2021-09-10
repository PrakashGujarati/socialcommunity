<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class statusController extends Controller
{

    public function statusUpdate($model, Request $request)
    {
        $modelName = "App\\Models\\".$model;
        $data = $modelName::where('id',$request->id)->first();
        $data->update([
            'status' => $data->status == "Active" ? "Deactive" : "Active"
        ]);
        return redirect()->route(strtolower($model).'.index');
    }
}
