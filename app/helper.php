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
            array_push($mediaNames,$publicDirectoryName."/".$mediaName);
        }
        return json_encode($mediaNames,true);
    } else {
        $mediaName = time().".".$mediaFile->getClientOriginalExtension();
        $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
        return $publicDirectoryName."/".$mediaName;
    }
}

function globallyUpdateMedia($data,$mediaFile,$publicDirectoryName,$keyName,$multiple = false)
{
    globallyDeleteMedia($data,$publicDirectoryName,$keyName,$multiple);
    if ($multiple) {
        $mediaNames = [];
        if ($data->$keyName != "") {
            foreach (json_decode($data->$keyName) as $key => $filename) {
                ($filename && file_exists(public_path()."/".$filename)) ? unlink(public_path()."/".$filename) : "";
            }
        }
        foreach ($mediaFile as $key => $file) {
            $mediaName = time().$key.".".$file->getClientOriginalExtension();
            $file->move(public_path().$publicDirectoryName,$mediaName);
            array_push($mediaNames,$publicDirectoryName."/".$mediaName);
        }
        $data->update([$keyName => json_encode($mediaNames,true)]);
    } else {
        $mediaName = time().".".$mediaFile->getClientOriginalExtension();
        $mediaFile->move(public_path().$publicDirectoryName,$mediaName);
        $data->update([$keyName => $publicDirectoryName."/".$mediaName]);
    }

}

function globallyDeleteMedia($data,$publicDirectoryName,$keyName,$multiple = false)
{
    if ($multiple) {
        if ($data->$keyName != "") {
            foreach (json_decode($data->$keyName) as $key => $filename) {
                ($filename && file_exists(public_path()."/".$filename)) ? unlink(public_path()."/".$filename) : "";
            }
        }
    } else {
        ($data->$keyName && file_exists(public_path()."/".$data->$keyName)) ? unlink(public_path()."/".$data->$keyName) : "";
    }
}
