<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use App\Models\User;
use COM;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::with('user')->withCount('articles')->orderBy('id' , 'desc')->paginate(5);
        $this->authorize('viewAny' , Author::class);

        return response()->view('cms.author.index' , compact('authors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $roles = Role::where('guard_name' , 'author')->get();
        $this->authorize('create' , Author::class);

        return response()->view('cms.author.create' , compact('cities' , 'roles'));
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
            'firstname' => 'required' ,
            'email' => 'required|unique:authors,email' ,
        ]);
        if(! $validator->fails()) {
            $authors = new Author();
            $authors->email = $request->get('email');
            $authors->password = Hash::make($request->get('password'));

            $isSaved = $authors->save();

            if($isSaved) {
            $users = new User();

            $roles = Role::findOrFail($request->get('role_id'));
            $authors->assignRole($roles->name);

            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/author' , $imageName); //move or storeAs
                $users->image = $imageName;
            }
            $users->firstname = $request->get('firstname');
            $users->lastname = $request->get('lastname');
            $users->mobile = $request->get('mobile');
            $users->date = $request->get('date');
            $users->gender = $request->get('gender');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($authors);

            $isSaved = $users->save();
        }

            return response()->json([
                'icon' => 'success',
                'title' => 'Created is Successfuly',
            ] , 200);

        }
        else {
            return response()->json([
                'icon' => 'error',
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
        $authors = Author::findOrFail($id);
        return response()->view('cms.author.show' , compact('authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $authors = Author::findOrFail($id);
        $cities = City::all();
        $roles = Role::where('guard_name' , 'author')->get();


        return response()->view('cms.author.edit' , compact('authors' , 'cities', 'roles'));
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
            'password' => 'nullable',

        ] , [

        ]);
        if(! $validator->fails()) {
            $authors = Author::findOrFail($id);
            $authors->email = $request->get('email');

            $isUpdated = $authors->save();
        if($isUpdated) {
            $users = $authors->user;

            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/author' , $imageName); //move or storeAs
                $users->image = $imageName;
            }
            $users->firstname = $request->get('firstname');
            $users->lastname = $request->get('lastname');
            $users->mobile = $request->get('mobile');
            $users->date = $request->get('date');
            $users->gender = $request->get('gender');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($authors);

            $isUpdated = $users->save();
        }

            return  ['redirect' => route('authors.index')];

            return response()->json([
                'icon' => 'success',
                'title' => 'Updated is Successfuly',
            ] , 200);

        }
        else {
            return response()->json([
                'icon' => 'error',
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
        $authors = Author::destroy($id);

    }
}
