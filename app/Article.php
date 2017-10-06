<?php

namespace App;

use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function pictures()
    {
    	return $this->hasMany('App\Picture', 'article_key', 'key');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope);
    }    
}
