<?php

use Illuminate\Database\Seeder;

class HiddenNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new \App\Page();
        $page->title = 'Home';
        $page->menu_name = 'Home';
        $page->seo_url = 'home';
        $page->hidden_name = 'home';
        $page->on_top = null;
        $page->on_bottom = null;
        $page->save();

        $page = new \App\Page();
        $page->title = '';
        $page->menu_name = 'Find an Event';
        $page->seo_url = 'find';
        $page->hidden_name = 'find event';
        $page->on_top = 1;
        $page->on_bottom = null;
        $page->save();

        $page = new \App\Page();
        $page->title = 'FAQ';
        $page->menu_name = 'FAQ';
        $page->seo_url = 'faq';
        $page->hidden_name = 'faq';
        $page->on_top = null;
        $page->on_bottom = 1;
        $page->save();

        $page = new \App\Page();
        $page->title = 'Security';
        $page->menu_name = 'Secure';
        $page->seo_url = '/';
        $page->hidden_name = 'secure';
        $page->on_top = 1;
        $page->on_bottom = 1;
        $page->save();

        $page = new \App\Page();
        $page->title = 'Blog';
        $page->menu_name = 'Blog';
        $page->seo_url = 'blog';
        $page->hidden_name = 'blog';
        $page->on_top = null;
        $page->on_bottom = 1;
        $page->save();
    }
}
