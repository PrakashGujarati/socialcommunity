<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public $rules = [
        'first_name' => 'required',
        'contact' => 'required|numeric',
        'picture' => 'mimes:jpeg,jpg,png'
    ];

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $data = Candidate::where('status','=','Active')->get();                
        return $this->responseOut($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return ['status' => "false",'msg' => $validator->messages()];
        }

        $pictureName = '';

        if ($mediaFile = $request->file('picture')) {
            $mediaPath = public_path()."/candidate_pictures";
            $pictureName = time().".".$mediaFile->getClientOriginalExtension();
            $mediaFile->move($mediaPath,$pictureName);
        }

        $newCandidate = Candidate::create([
            'user_id' => Auth::user()->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'birth_time' => $request->birth_time,
            'birth_place' => $request->birth_place,
            'height' => $request->height,
            'weight' => $request->weight,
            'education' => $request->education,
            'occupation' => $request->occupation,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'brothers' => $request->brothers,
            'sisters' => $request->sisters,
            'father_occupation' => $request->father_occupation,
            'mother_occupation' => $request->mother_occupation,
            'father_contact' => $request->father_contact,
            'contact' => $request->contact,
            'email' => $request->email,
            'resident_address' => $request->resident_address,
            'native_address' => $request->native_address,
            'maternal' => $request->maternal,
            'maternal_place' => $request->maternal_place,
            'hobbies' => $request->hobbies,
            'expectations' => $request->expectations,
            'remark' => $request->remark,
            'picture' => $pictureName,
            'status' => 'Inactive',
            'done_by' => Auth::user()->id
        ]);

        return $this->responseOut($newCandidate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Candidate::where(['id' => $request->candidate_id])->first();
        return $this->responseOut($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    
        $candidate = Candidate::where(['id'=>$request->candidate_id,'user_id'=>Auth::user()->id])->first();

        if (!empty($candidate)) {

            $validator = Validator::make($request->all(), $this->rules);

            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }

            if ($mediaFile = $request->file('picture')) {
                $mediaPath = public_path()."/candidate_pictures";
                ($candidate->picture && file_exists($mediaPath."/".$candidate->picture)) ? unlink($mediaPath."/".$candidate->picture) : "";
                $pictureName = time().".".$mediaFile->getClientOriginalExtension();
                $mediaFile->move($mediaPath,$pictureName);
                $candidate->update(['picture' => $pictureName]);
            }

            $candidate->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'birth_time' => $request->birth_time,
                'birth_place' => $request->birth_place,
                'height' => $request->height,
                'weight' => $request->weight,
                'education' => $request->education,
                'occupation' => $request->occupation,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'brothers' => $request->brothers,
                'sisters' => $request->sisters,
                'father_occupation' => $request->father_occupation,
                'mother_occupation' => $request->mother_occupation,
                'father_contact' => $request->father_contact,
                'contact' => $request->contact,
                'email' => $request->email,
                'resident_address' => $request->resident_address,
                'native_address' => $request->native_address,
                'maternal' => $request->maternal,
                'maternal_place' => $request->maternal_place,
                'hobbies' => $request->hobbies,
                'expectations' => $request->expectations,
                'remark' => $request->remark
            ]);
            return $this->responseOut($candidate);
        } else {
            return $this->responseOut($candidate);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getListUpdate(Request $request)
    {
       
        $candidate = Candidate::where(['id' => $request->candidate_id]);
        
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->fails()) {
                return ['status' => "false",'msg' => $validator->messages()];
            }           
           
            $candidate->update([
                'column_status' => $request->column_status                
            ]);            
        
            return $this->responseOut($candidate);
        
    }

    public function getCandidateList(Request $request)
    {
       
        $candidateList = Candidate::find(['id' => $request->candidate_id])->first();
        
        $candidateList->makeHidden(explode(",", $candidateList->column_status));            
        
        return $this->responseOut($candidateList);
    }

    public function responseOut($data)
    {
        if (!empty($data)) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'No Candidate Found !',
                'data' => []
            ]);
        }
    }
}
