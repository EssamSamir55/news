<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
/*****************************************Function-Home*****************************************/
    public function home(){
        $categories = Category::where('status' , 'active')->orderBy('name' , 'asc')->take(3)->get();
        $sliders = Slider::take(3)->get();
        $articles = Article::orderBy('created_at','desc')->take(3)->get();
        // $articlesC = Article::orderBy('created_at','desc')->get();
        return view('front.index' , compact('categories','sliders','articles'));
    }
    

/*****************************************Function-Detailes*****************************************/
    public function det($id) {
        $articles = Article::find($id);
        return view('front.newsdetailes' , compact('articles'));
    }


/*****************************************Function-AllNews*****************************************/
    public function all($id) {
        $categories = Category::findOrFail($id);
        $articles = Article::where('category_id', $id)->orderBy('id','desc')->paginate(4);
        return view('front.all-news' , compact('categories' , 'articles'));
    }


/*****************************************Function-showContact*****************************************/
    public function showContact() {
        return view('front\contact');
    }


/*****************************************Function-storeContact*****************************************/
    public function storeContact(Request $request)
    {
        $validator = Validator($request->all(), [
            // 'fullname' => 'required',
            // 'email' => 'required|email' ,
            // 'mobile' => 'required' ,
        ]);

        if(! $validator->fails()){
            $contacts = new Contact();
            $contacts->fullname = $request->get('fullname');
            $contacts->email = $request->get('email');
            $contacts->mobile = $request->get('mobile');
            $contacts->message = $request->get('message');

            $isSaved = $contacts->save();

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
}
