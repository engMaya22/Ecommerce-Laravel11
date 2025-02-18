<?php

namespace App\View\Components\Shop;

use App\Http\Requests\AddReviewRequest;
use App\Models\Product;
use App\Models\Review as ModelsReview;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Review extends Component
{
    /**
     * Create a new component instance.
     */
    protected Product  $product;
    public $reviews;
    public $id;
    public function __construct($id )
    {
        $this->id = $id;
        $this->product = Product::find($id);
        $this->reviews = $this->product->reviews()->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shop.review');
    }

}
