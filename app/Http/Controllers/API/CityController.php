<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cities = City::select('name' , 'street')->get();
        $cities = City::all();
        // $cities = City::where('country_id' , '3')->get();

        return response()->json([
            'status' => true,
            'message' => 'Data of City',
            'data' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all() , [
            'name' => 'required',
            'street' => 'nullable',
            'country_id' => 'required',
        ] , [

        ]);
        if(! $validator->fails()) {
            $cities = new City();
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');

            $isSaved = $cities->save();

            return response()->json([
                'status' => true,
                'message' => 'created is successfully'
            ] , 200);

        }
        else {
            return response()->json([
                'status' => false,
                'title' => $validator->getMessageBag()->first(),
            ] , 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cities = City::findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Data of City',
            'data' => $cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all() , [
            'name' => 'required',
            'street' => 'nullable',
            'country_id' => 'required',
        ] , [

        ]);
        if(! $validator->fails()) {
            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');

            $isUpdated = $cities->save();
            // return  ['redirect' => route('cities.index')];

            return response()->json([
                'status' => true,
                'message' => 'Updated is Successfuly',
            ] , 200);

        }
        else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
            ] , 400);
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
        $cities = City::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Deleted is Successfuly',
        ] , 200);
    }
}
