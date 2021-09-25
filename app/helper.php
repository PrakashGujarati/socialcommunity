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

function globallyStoreMedia($mediaFile,$publicDirectoryName)
{
    $mediaName = time().".".$mediaFile->getClientOriginalExtension();
    $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
    return $mediaName;
}

function globallyUpdateMedia($data,$mediaFile,$publicDirectoryName,$keyName)
{
    ($data->$keyName && file_exists(public_path().$publicDirectoryName."/".$data->$keyName)) ? unlink(public_path().$publicDirectoryName."/".$data->$keyName) : "";
    $mediaName = time().".".$mediaFile->getClientOriginalExtension();
    $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
    $data->update([$keyName => $mediaName]);
}

function globallyDeleteMedia($data,$publicDirectoryName,$keyName)
{
    ($data->$keyName && file_exists(public_path().$publicDirectoryName."/".$data->$keyName)) ? unlink(public_path().$publicDirectoryName."/".$data->$keyName) : "";
}
