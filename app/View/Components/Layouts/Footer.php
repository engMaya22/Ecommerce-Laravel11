<?php

namespace App\View\Components\Layouts;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public $products;
    public function __construct()
    {
        $this->categories = Category::orderBy('created_at','DESC')->get()->take(4);
        $this->products = Product::orderBy('created_at','DESC')->get()->take(4);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.footer');
    }
}
