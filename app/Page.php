<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'brief','on_top','on_bottom','parent_id','title', 'content', 'seo_title', 'seo_description', 'seo_keywords', 'sort_order', 'manage_pages', 'menu_name', 'seo_url'
    ];
    public function page()
    {
        return $this->hasOne(Page::class,'parent_id');
    }
    public function pages()
    {
        return $this->hasMany(Page::class,'parent_id');
    }
}
