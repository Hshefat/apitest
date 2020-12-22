<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\person;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    //
    public function index()
    {

        $person = DB::table('people')->get();
        return response()->json($person);
        // return Person::all();
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'person_name' => 'required|unique:people|max:25'
        ]);
        $data = array();
        $data['person_name'] = $request->person_name;
        DB::table('people')->insert($data);
        return response('Ok the API');
    }
    public function destroy($id)
    {
        DB::table('people')->where('id', $id)->delete();
        return response($id . ' is deleted');
    }
    public function show($id)
    {
        $dataShow = DB::table('people')->where('id', $id)->first();
        return response()->json($dataShow);
    }
    public function update(Request $request, $id)
    {
        $data = array();
        $data['person_name'] = $request->person_name;
        DB::table('people')->where('id', $id)->update($data);
        return response($id . ' is updated');
    }
}