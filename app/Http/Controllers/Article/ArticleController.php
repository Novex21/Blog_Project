<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article; //important to import the model
use App\Models\Category;
use Illuminate\Support\Facades\Gate; //**************



class ArticleController extends Controller
{

  public function __construct()
  {
        $this->middleware('auth')->except('index');
  }

  public function index()
  {

    $data = Article::latest()->paginate(5);    //နောက်ဆုံးကနေ ၅ခုစီပြ

    return view('articles.index', [           //  pathway ကို"/" အစား "."ကိုလည်းသုံးနိုင်ပါတယ်
      'articles' => $data
    ]);
  }

  public function detail($id)
  {

    $data = Article::find($id);

    return view('articles.detail', [
      'article' => $data   ///be careful about the variables names
    ]);
  }

  public function add()
  {
    $data = Category::all();
    return view('articles.add', [
      'categories' => $data
    ]);
  }

  public function create()
  {

    $validator = validator(request()->all(), [
      'article_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
      'title' => 'required',
      'body' => 'required',
      'category_id' => 'required'
    ]);

    if($validator->fails()) {
      return back()->withErrors($validator);
    }

    $article = new Article;
    $article->title = request()->title;
    $article->body = request()->input('body'); //same with request()->body;
    $article->category_id = request()->category_id;
    $article->user_id = auth()->user()->id;
    $path =  request()->file('article_photo')->store('article_photos','public');
    $article->article_photo = $path;
    $article->save();

    return redirect('/articles');
  }

  public function delete($id)
  {
    $article = Article::find($id);
    if(Gate::denies('article-delete', $article)) { // ပြန်သုံးတဲ့အချိန်မှာ User ကို ထည့်ပေးစရာမလိုပါဘူး။Laravel က သူ့ဘာသာ ထည့်ပေးသွားပါတယ်။
      return back()->with('error', 'Unauthorized');
    }

    $article->delete();

    return redirect('/articles')->with('info','Article deleted');
  }

  public function edit($id)
  {
    $article = Article::find($id);
    if(Gate::denies('article-edit', $article)) { // ပြန်သုံးတဲ့အချိန်မှာ User ကို ထည့်ပေးစရာမလိုပါဘူး။Laravel က သူ့ဘာသာ ထည့်ပေးသွားပါတယ်။
      return back()->with('error', 'Unauthorized');
    }
    $data = $article;
    $data2 = Category::all();
    return view('articles.edit', [
      "article" => $data,
      "categories" => $data2,
    ]);
  }

  public function update($id)
  {

    $validator = validator(request()->all(), [
        'article_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $article = Article::find($id);
    if(Gate::denies('article-edit', $article)) { // ပြန်သုံးတဲ့အချိန်မှာ User ကို ထည့်ပေးစရာမလိုပါဘူး။Laravel က သူ့ဘာသာ ထည့်ပေးသွားပါတယ်။
      return back()->with('error', 'Unauthorized');
    }
    $article->title = request()->title;
    $article->body = request()->input('body');
    $article->category_id = request()->category_id;
    $path =  request()->file('article_photo')->store('article_photos','public');
    $article->article_photo = $path;
    $article->user_id = auth()->user()->id;
    $article->update();

    return redirect('/articles');
  }

}
