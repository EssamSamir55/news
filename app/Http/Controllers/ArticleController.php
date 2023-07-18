<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexArticle($id)
    {
        //
        $articles = Article::where('author_id', $id)->orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.article.index', compact('articles','id'));
    }

    public function createArticle($id)
    {
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.create', compact('authors',  'categories' , 'id'));
    }

    public function index()
    {
        $articles = Article::with('category')->orderBy('id' , 'desc')->simplePaginate(5);
        return response()->view('cms.article.indexAll' , compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.create' , compact('authors' , 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [

        ]);

        if(! $validator->fails()){
            $articles = new Article();
            if(! $validator->fails()){

                if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                    $image = $request->file('image');
                    $imageName = time() . 'image' . $image->getClientOriginalExtension();
                    $image->move('storage/images/article' , $imageName); //move or storeAs
                    $articles->image = $imageName;
                }
            $articles->title = $request->get('title');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');

            $isSaved = $articles->save();
            return response()->json([
                'icon' => 'success',
                'title' => $isSaved ? "Created is Successfully" : "created is Failed"
            ] ,  $isSaved ? 200 : 400);

        }
        else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ] ,400);
        }
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
        $articles = Article::findOrFail($id);
        return response()->view('cms.article.show' , compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articles = Article::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();
        return response()->view('cms.article.edit' , compact('authors' , 'categories' ,'articles'));

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
        $validator = Validator($request->all() , [

        ]);

        if(! $validator->fails()){
            $articles =  Article::findOrFail($id);

            if(! $validator->fails()){
                $articles =  Article::findOrFail($id);

                if(request()->hasFile('image')){//اسم العمود في الداتا بيز
                    $image = $request->file('image');
                    $imageName = time() . 'image' . $image->getClientOriginalExtension();
                    $image->move('storage/images/article' , $imageName); //move or storeAs
                    $articles->image = $imageName;
                }

            $articles->title = $request->get('title');
            $articles->short_description = $request->get('short_description');
            $articles->full_description = $request->get('full_description');
            $articles->author_id = $request->get('author_id');
            $articles->category_id = $request->get('category_id');

            $isUpdate = $articles->save();
            return  ['redirect' => route('articles.index')];

            return response()->json([
                'icon' => 'success',
                'title' => $isUpdate ? "Updated is Successfully" : "Updated is Failed"
            ] ,  $isUpdate ? 200 : 400);

        }
        else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first()
            ] ,400);
        }
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
        $articles =  Article::destroy($id);
    }
}
