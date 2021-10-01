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

function globallyStoreMedia($mediaFile, $publicDirectoryName, $multiple = false)
{
    if ($multiple) {
        $mediaNames = [];
        foreach ($mediaFile as $key => $file) {
            $mediaName = time().$key.".".$file->getClientOriginalExtension();
            $file->move(public_path().$publicDirectoryName,$mediaName);
            array_push($mediaNames,$mediaName);
        }
        return json_encode($mediaNames,true);
    } else {
        $mediaName = time().".".$mediaFile->getClientOriginalExtension();
        $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
        return $mediaName;
    }
}

function globallyUpdateMedia($data,$mediaFile,$publicDirectoryName,$keyName,$multiple = false)
{
    if ($multiple) {
        $mediaNames = [];
        if ($data->$keyName != "") {
            foreach (json_decode($data->$keyName) as $key => $filename) {
                ($filename && file_exists(public_path().$publicDirectoryName."/".$filename)) ? unlink(public_path().$publicDirectoryName."/".$filename) : "";
            }
        }
        foreach ($mediaFile as $key => $file) {
            $mediaName = time().$key.".".$file->getClientOriginalExtension();
            $file->move(public_path().$publicDirectoryName,$mediaName);
            array_push($mediaNames,$mediaName);
        }
        $data->update([$keyName => json_encode($mediaNames,true)]);
    } else {
        ($data->$keyName && file_exists(public_path().$publicDirectoryName."/".$data->$keyName)) ? unlink(public_path().$publicDirectoryName."/".$data->$keyName) : "";
        $mediaName = time().".".$mediaFile->getClientOriginalExtension();
        $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
        $data->update([$keyName => $mediaName]);
    }

}

function globallyDeleteMedia($data,$publicDirectoryName,$keyName,$multiple = false)
{
    if ($multiple) {
        if ($data->$keyName != "") {
            foreach (json_decode($data->$keyName) as $key => $filename) {
                ($filename && file_exists(public_path().$publicDirectoryName."/".$filename)) ? unlink(public_path().$publicDirectoryName."/".$filename) : "";
            }
        }
    } else {
        ($data->$keyName && file_exists(public_path().$publicDirectoryName."/".$data->$keyName)) ? unlink(public_path().$publicDirectoryName."/".$data->$keyName) : "";
    }

}
