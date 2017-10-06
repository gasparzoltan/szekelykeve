<?php

namespace App\Http\Controllers;


use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function view($slug)
    {
    	$article = Article::with('category')->where('slug', $slug)->firstOrFail();

    	$latests = Article::with('category')->where('id', '!=', $article->id)->orderBy('id', 'DESC')->paginate(5);

    	return view('article/view', compact('article', 'latests'));
    }
}
