<?php

namespace App\Http\Controllers;
use App\Models\Slider;

use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('id' , 'desc')->paginate(5);

        return response()->view('cms.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'title' => 'required',
            'image' => 'nullable',
            'description' => 'nullable',

        ]);

        if(! $validator->fails()){
            $sliders = new Slider();
            $sliders->title = $request->get('title');
            $sliders->description = $request->get('description');

            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/slider' , $imageName); //move or storeAs
                $sliders->image = $imageName;
            }

            $isSaved = $sliders->save();

            return response()->json([
                'icon' => 'success' ,
                'title' => 'Created is Successfully',
            ] , 200);

        }
        else{
            return response()->json([
                'icon' => 'error' ,
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
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.show' , compact('sliders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sliders = Slider::findOrFail($id);
        return response()->view('cms.slider.edit' , compact('sliders'));
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

        $validator = Validator($request->all(), [
            'title' => 'required',
            'image' => 'nullable',
            'description' => 'nullable',
        ]);

        if(! $validator->fails()){
            $sliders = Slider::findOrFail($id);
            $sliders->title = $request->get('title');
            $sliders->description = $request->get('description');

            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/slider' , $imageName); //move or storeAs
                $sliders->image = $imageName;
            }

            $isUpdate = $sliders->save();

            return response()->json([
                'icon' => 'success' ,
                'title' => 'Created is Successfully',
            ] , 200);

        }
        else{
            return response()->json([
                'icon' => 'error' ,
                'title' => $validator->getMessageBag()->first(),
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
        $sliders = Slider::destroy($id);
    }
}
