<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use COM;
use Dotenv\Validator;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = Admin::with('user')->orderBy('id' , 'desc')->paginate(5);
        $this->authorize('viewAny' , Admin::class);
        return response()->view('cms.admin.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $roles = Role::where('guard_name' , 'admin')->get();
        $this->authorize('create' , Admin::class);
        return response()->view('cms.admin.create' , compact('cities' , 'roles'));
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
            'firstname' => 'required',
            'email' => 'required|email' ,
        ]);
        if(! $validator->fails()) {
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));

            $isSaved = $admins->save();

            if($isSaved) {
            $users = new User();

            $roles = Role::findOrFail($request->get('role_id'));
            $admins->assignRole($roles->name);

            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/admin' , $imageName); //move or storeAs
                $users->image = $imageName;
            }
            $users->firstname = $request->get('firstname');
            $users->lastname = $request->get('lastname');
            $users->mobile = $request->get('mobile');
            $users->date = $request->get('date');
            $users->gender = $request->get('gender');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($admins);

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
        $admins = Admin::findOrFail($id);
        return response()->view('cms.admin.show' , compact('admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $cities = City::all();
        $roles = Role::where('guard_name' , 'admin')->get();


        return response()->view('cms.admin.edit' , compact('admins' , 'cities','roles'));
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
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');

            $isUpdated = $admins->save();
        if($isUpdated) {
            $users = $admins->user;
            // $roles = Role::findOrFail($request->get('role_id'));
            // $admins->assignRole($roles->name);


            if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                $image = $request->file('image');
                $imageName = time() . 'image' . $image->getClientOriginalExtension();
                $image->move('storage/images/admin' , $imageName); //move or storeAs
                $users->image = $imageName;
            }
            $users->firstname = $request->get('firstname');
            $users->lastname = $request->get('lastname');
            $users->mobile = $request->get('mobile');
            $users->date = $request->get('date');
            $users->gender = $request->get('gender');
            $users->status = $request->get('status');
            $users->city_id = $request->get('city_id');
            $users->actor()->associate($admins);

            $isUpdated = $users->save();
        }

            return  ['redirect' => route('admins.index')];

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
        $admins = Admin::destroy($id);

    }
}
