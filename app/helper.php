<?php
function statusUpdate($model, $id)
{
    $modelName = "App\\Models\\".$model;
    $data = $modelName::where('id',$id)->first();
    $data->update([
        'status' => $data->status == "Active" ? "Deactive" : "Active"
    ]);
    return redirect()->route(strtolower($model).'.index');
}
