<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\VisitorCountry;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $categories = Category::with('articles')->get();
        $highlightedArticle = Article::with('category')->where('highlighted', 1)->first();
        $visitors = VisitorCountry::orderBy('times_visited', 'DESC')->get();

        $articles = Article::with('category')->orderBy('id', 'DESC');
        if($highlightedArticle) {
            $articles = $articles->where('id', '!=', $highlightedArticle->id);
        }
        $articles = $articles->paginate(10);

        return view('landing', compact('highlightedArticle', 'articles', 'categories', 'visitors'));
    }

    public function addVisitor($code)
    {
        dd($code);
    }
}
