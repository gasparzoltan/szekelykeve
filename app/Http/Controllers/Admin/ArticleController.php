<?php

namespace App\Http\Controllers\Admin;


Use Auth;
Use Image;
Use App\Picture;
use App\Article;
use App\Category;
use Faker\Factory;
use Illuminate\Http\Request;
use App\Scopes\PublishedScope;
use App\Http\Controllers\Controller;


class ArticleController extends Controller
{

// Show all articles
    public function index(Request $request)
    {    

        $articles_count = Article::all()->count();
        $articles = Article::with('category')->with('pictures')->orderBy('id', 'DESC');
        if($request->input('cat_id') !== NULL) {
            $articles = $articles->where('category_id', $request->input('cat_id'));
        }
        $articles = $articles->paginate(15);

        $categories = Category::with('articles')->get();

        return view('admin/articles/index', compact('articles', 'categories', 'articles_count'));
    }

// Create article
    public function create()
    {
    	$categories = Category::all();
        $key = str_random(40);
    	
        return redirect()->route('admin.cikk.szerkesztes', $key);
    }

    public function create2($key) 
    {
        $article = Article::withoutGlobalScopes()->where('key', $key)->first();
        if(!$article) {
            $article = new Article;
        }
        $categories = Category::all();        

        return view('admin/articles/create', compact('article', 'categories', 'key'));
    }

// Save article
    public function save(Request $request, $key)
    {               
       
    	$this->validate($request, [
			'title' => 'required|max:255|min:2',
			'content' => 'required|min:10',
			'category_id' => 'required|integer|min:1|max:5'            
    	]);

        $msg = '';


        $article = Article::withoutGlobalScopes()->where('key', $key)->first();
        if(!$article) {
            $article = new Article;
            $article->key = $key;
            $article->user_id = Auth::user()->id;        
        }

        $article->title = $request->input('title');
        $article->slug = str_slug($request->input('title'), '-');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');
        

        if($request->input('status') == 'on') {
            
            $msg = "Mentés sikeres. A cikk publikus";
            $article->published_at = $article->created_at;
        } else {
            $msg = "Mentés sikeres. A cikk privát";
            $article->published_at = null;
        }
        
        if($request->input('highlighted') == "on") {

            Article::withoutGlobalScopes()->where('highlighted', 1)->update(['highlighted' => 0]);

            Article::withoutGlobalScopes()->where('key', $key)->update(['highlighted' => 1]);                        
            
        } else {
            $article->highlighted = 0;
        }

        $article->save();



        return response()->json(['msg' => $msg], 200);


    }



// Delete article
    public function delete($articleId)
    {        
        $article = Article::with('pictures')->where('id', $articleId)->firstOrFail();
        
        foreach($article->pictures as $picture) {            
            $this->deleteImageFile($pictures->name);
            $picture->delete();
        }
        
    }


    public function uploadImages(Request $request, $key)
    {        
        if(Article::withoutGlobalScope(PublishedScope::class)->where('key', '=', $key)->count() == 0) {            
            $this->starterArticle($key);            
        }


        foreach($request->all()["images"] as $img) {
            $imageName = str_random(20) . '-' . time().'.jpg';
            $img->move(public_path().'/images/article/', $imageName);

            $image = Image::make(public_path('images/article/'.$imageName));

            // Full size image
            if($image->width() > 1200) {
                $image->resize(1200, null, function($c) {
                    $c->aspectRatio();
                });     
                $image->save(public_path('images/article/'.$imageName));
            }     
            

            // Create medium
            $image->resize(null, 320, function($c) {
                $c->aspectRatio();
            });

            if($image->width() < 650) {
                $image->resize(650, null, function($c) {
                    $c->aspectRatio();
                });                
            }
            $image->resizeCanvas(650,320);
            $image->save(public_path('images/article/medium_'.$imageName));             


            // Create thumbnail
            $image->resize(null, 142, function($c) {
                $c->aspectRatio();
            });
            /*$image->save(public_path('images/article/thumb_'.$imageName));*/
            $image->resizeCanvas(210, 142);
            $image->save(public_path('images/article/thumb_'.$imageName));             

            $picture = new Picture;
            $picture->article_key = $key;
            $picture->name = $imageName;       
            $picture->save();     
        }
        
    }

    public function getImages($key)  
    {
        $images = Picture::where('article_key', $key)->orderBy('id', 'DESC')->get();        

        return response()->json(['images' => view('admin/articles/_ajax_render/imageList', compact('images'))->render()], 200);
    }


    public function setAsThumbnail($imgId)
    {


        $image = Picture::findOrFail($imgId);

        $all = Picture::where('article_key', $image->article_key)->where('is_thumbnail_image', 1)->where('id', '!=', $image->id)->get();
        foreach($all as $a) {
            $a->is_thumbnail_image = 0;
            $a->save();
        }

        if($image->is_thumbnail_image == 0) {
            $image->is_thumbnail_image = 1;
            $image->save();            
        }

        
        $article = Article::withoutGlobalScopes()->where('key', $image->article_key)->firstOrFail();
        $article->image = $image->name;
        $article->save();
        



        return response()->json(['msg' => $image->name], 200);
    }

    public function setAsGallery($imgId)
    {
        $image = Picture::findOrFail($imgId);           
        
        if($image->is_gallery_image == 1) {
            $image->is_gallery_image = 0;            
        } else {
            $image->is_gallery_image = 1;
        }

        $image->save();

        return response()->json(['msg' => 'Művelet végrehajtva'], 200);
    }    


// Delete image
    public function deleteImage($imgId)
    {
        $image = Picture::findOrFail($imgId);
        $article = Article::withoutGlobalScopes()->where('key', $image->article_key)->firstOrFail();

        if($image->name == $article->image) {
            $article->image = '';
            $article->save();
        }

        $imagePath = public_path() . '/images/article/' . $image->name;

        $this->deleteImageFile($image->name);

        $image->delete();

        return response()->json(['msg' => $imagePath], 200);
    }


// Private delete image
    private function deleteImageFile($name)
    {
        $imagePath = public_path() . '/images/article/' . $name;
        $mediumPath = public_path() . '/images/article/medium_' . $name;
        $thumbPath = public_path() . '/images/article/thumb_' . $name;
        if(file_exists($imagePath) && @getimagesize($imagePath)) {
            unlink($imagePath);
        }
        if(file_exists($thumbPath) && @getimagesize($thumbPath)) {
            unlink($thumbPath);
        }            
        if(file_exists($mediumPath) && @getimagesize($mediumPath)) {
            unlink($mediumPath);
        }        
    }

    private function starterArticle($key)
    {
        $article = new Article;
        $article->key = $key;
        $article->user_id = Auth::user()->id;
        $article->save();
    }
}
