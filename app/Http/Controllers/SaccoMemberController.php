<?php

namespace App\Http\Controllers;

use App\Models\SaccoMember;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Utils;

class SaccoMemberController extends Controller
{
    public function index()
    {
        return SaccoMember::all();
    }

    //get sacco member by id
    public function show($id)
    {
        return  $saccoMember = SaccoMember::where('user_id', $id)->firstOrFail();
    }

    //create sacco member
    public function store(Request $request)
    {
      
        $data = $request->except('image'); // Exclude 'image' from mass assignment
        $rules = [
            
            'user_id' => 'nullable|integer',
            // Add other validation rules here...
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $member = SaccoMember::create($data);

        return Utils::apiSuccess($member, 'Sacco member registered successfully.');
    }

    //edit sacco member
    public function update(Request $request, $id)
    {
        $saccoMember = SaccoMember::where('user_id', $id)->firstOrFail();

        $data = $request->except(['image', '_method']); // Exclude 'image' and '_method'
        $rules = [
            'sacco_id' => 'required|integer',
            'user_id' => 'nullable|integer',
            // Add other validation rules here...
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $saccoMember->update($data);
        return $saccoMember;
    }

    //delete Sacco Member
    public function destroy($id)
    {
        $saccoMember = SaccoMember::where('user_id', $id)->firstOrFail();
        $saccoMember->delete();
        return response()->json(['message' => 'Successfully deleted.']);
    }
}

