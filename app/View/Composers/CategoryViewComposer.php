<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryViewComposer {

    public function compose(View $view)
    {
        $main_categories = Category::orderBy('id')->get();
        $view->with('main_categories', $main_categories);
    }
}