@extends('layouts.app')
@section('content')
   <style>
     .filled-heart{
        color: orange;

     }
   </style>

  <main class="pt-90">
    <section class="container pt-4 shop-main d-flex pt-xl-5">
      <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
        <div class="aside-header d-flex d-lg-none align-items-center">
          <h3 class="mb-0 text-uppercase fs-6">Filter By</h3>
          <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
        </div>

        <div class="pt-4 pt-lg-0"></div>

        <div class="accordion" id="categories-list">
          <div class="pb-3 mb-4 accordion-item">
            <h5 class="accordion-header" id="accordion-heading-1">
              <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1">
                Product Categories
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-1" class="border-0 accordion-collapse collapse show"
              aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
              <div class="px-0 pt-3 pb-0 accordion-body category-list">
                <ul class="mb-0 list list-inline">
                    @foreach ($categories as $category)
                      <li class="list-item">
                        <span class="py-1 menu-link">
                            <input type="checkbox" name="categories" value="{{ $category->id }}" class="chk-category"
                                @if (in_array($category->id, explode(',', $categoriesFilter ?? ''))) checked @endif
                                >
                            {{ $category->name }}
                        </span>
                        <span class="text-right float-end">
                            {{$category->products->count()}}
                        </span>
                      </li>
                    @endforeach


                </ul>
              </div>
            </div>
          </div>
        </div>


        <div class="accordion" id="color-filters">
          <div class="pb-3 mb-4 accordion-item">
            <h5 class="accordion-header" id="accordion-heading-1">
              <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-2" aria-expanded="true" aria-controls="accordion-filter-2">
                Color
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-2" class="border-0 accordion-collapse collapse show"
              aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
              <div class="px-0 pb-0 accordion-body">
                <div class="flex-wrap d-flex">
                  <a href="#" class="swatch-color js-filter" style="color: #0a2472"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #d7bb4f"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #282828"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #b1d6e8"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #9c7539"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #d29b48"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #e6ae95"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #d76b67"></a>
                  <a href="#" class="swatch-color swatch_active js-filter" style="color: #bababa"></a>
                  <a href="#" class="swatch-color js-filter" style="color: #bfdcc4"></a>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="accordion" id="size-filters">
          <div class="pb-3 mb-4 accordion-item">
            <h5 class="accordion-header" id="accordion-heading-size">
              <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-size" aria-expanded="true" aria-controls="accordion-filter-size">
                Sizes
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-size" class="border-0 accordion-collapse collapse show"
              aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
              <div class="px-0 pb-0 accordion-body">
                <div class="flex-wrap d-flex">
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">XS</a>
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">S</a>
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">M</a>
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">L</a>
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">XL</a>
                  <a href="#" class="mb-3 swatch-size btn btn-sm btn-outline-light me-3 js-filter">XXL</a>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="accordion" id="brand-filters">
          <div class="pb-3 mb-4 accordion-item">
            <h5 class="accordion-header" id="accordion-heading-brand">
              <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-brand" aria-expanded="true" aria-controls="accordion-filter-brand">
                Brands
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-brand" class="border-0 accordion-collapse collapse show"
              aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
              <div class="px-0 pb-0 search-field multi-select accordion-body">
                <ul class="mb-0 list list-inline brand-list">
                    @foreach ($brands as $brand )
                        <li class="list-item">
                            <span class="py-1 menu-link">
                                <input type="checkbox" name="brands" value="{{ $brand->id }}" class="chk-brand"
                                    @if (in_array($brand->id, explode(',', $brandsFilter ?? ''))) checked @endif>
                                {{ $brand->name }}
                            </span>
                            <span class="text-right float-end">{{$brand->products->count()}}</span>
                        </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>


        <div class="accordion" id="price-filters">
          <div class="mb-4 accordion-item">
            <h5 class="mb-2 accordion-header" id="accordion-heading-price">
              <button class="p-0 border-0 accordion-button fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">
                Price
                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                  <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                    <path
                      d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                  </g>
                </svg>
              </button>
            </h5>
            <div id="accordion-filter-price" class="border-0 accordion-collapse collapse show"
              aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
              <input class="price-range-slider" type="text" name="price_range" value="" data-slider-min="{{$min}}"
                data-slider-max="{{$max}}" data-slider-step="5" data-slider-value="[{{$minPrice}},{{$maxPrice}}]" data-currency="$" />
              <div class="mt-2 price-range__info d-flex align-items-center">
                <div class="me-auto">
                  <span class="text-secondary">Min Price: </span>
                  <span class="price-range__min">${{$min}}</span>
                </div>
                <div>
                  <span class="text-secondary">Max Price: </span>
                  <span class="price-range__max">${{$max}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="shop-list flex-grow-1">
        <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                <div class="slide-split_text position-relative d-flex align-items-center"
                  style="background-color: #f5e6e0;">
                  <div class="container p-3 slideshow-text p-xl-5">
                    <h2
                      class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                      Women's <br /><strong>ACCESSORIES</strong></h2>
                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the best way to
                      update your look. Add a title edge with new styles and new colors, or go for timeless pieces.</h6>
                  </div>
                </div>
                <div class="slide-split_media position-relative">
                  <div class="slideshow-bg" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="assets/images/shop/shop_banner3.jpg" width="630" height="450"
                      alt="Women's accessories" class="slideshow-bg__img object-fit-cover" />
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                <div class="slide-split_text position-relative d-flex align-items-center"
                  style="background-color: #f5e6e0;">
                  <div class="container p-3 slideshow-text p-xl-5">
                    <h2
                      class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                      Women's <br /><strong>ACCESSORIES</strong></h2>
                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the best way to
                      update your look. Add a title edge with new styles and new colors, or go for timeless pieces.</h6>
                  </div>
                </div>
                <div class="slide-split_media position-relative">
                  <div class="slideshow-bg" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="assets/images/shop/shop_banner3.jpg" width="630" height="450"
                      alt="Women's accessories" class="slideshow-bg__img object-fit-cover" />
                  </div>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="overflow-hidden slide-split h-100 d-block d-md-flex">
                <div class="slide-split_text position-relative d-flex align-items-center"
                  style="background-color: #f5e6e0;">
                  <div class="container p-3 slideshow-text p-xl-5">
                    <h2
                      class="mb-3 text-uppercase section-title fw-normal animate animate_fade animate_btt animate_delay-2">
                      Women's <br /><strong>ACCESSORIES</strong></h2>
                    <p class="mb-0 animate animate_fade animate_btt animate_delay-5">Accessories are the best way to
                      update your look. Add a title edge with new styles and new colors, or go for timeless pieces.</h6>
                  </div>
                </div>
                <div class="slide-split_media position-relative">
                  <div class="slideshow-bg" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="assets/images/shop/shop_banner3.jpg" width="630" height="450"
                      alt="Women's accessories" class="slideshow-bg__img object-fit-cover" />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="container p-3 p-xl-5">
            <div class="bottom-0 mb-4 slideshow-pagination d-flex align-items-center position-absolute pb-xl-2"></div>

          </div>
        </div>

        <div class="pb-2 mb-3 pb-xl-3"></div>

        <div class="mb-4 d-flex justify-content-between pb-md-2">
          <div class="mb-0 breadcrumb d-none d-md-block flex-grow-1">
            <a href="{{route('home.index')}}" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
          </div>

          <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
            <select class="order-1 w-auto py-0 border-0 shop-acs__select form-select order-md-0" aria-label="Page Size"
            name="page_size" id="page_size" style="margin-right: 20px">
            <option value="12" {{ $size == '12' ? 'selected' : ''}}>Show</option>
            <option value="24"  {{ $size == '24' ? 'selected' : ''}}>24</option>
            <option value="48"  {{ $size == '48' ? 'selected' : ''}}>48</option>
            <option value="102"  {{ $size == '102' ? 'selected' : ''}}>102</option>


          </select>

            <select class="order-1 w-auto py-0 border-0 shop-acs__select form-select order-md-0" aria-label="Sort Items"
              name="orderBy" id="orderBy">
              <option  value="-1"  {{$order == -1 ? 'selected' : ''}}>Default</option>
              <option value="1" {{$order == 1 ? 'selected' : ''}}>Date , New to Old</option>
              <option value="2" {{$order == 2 ? 'selected' : ''}}>Date , Old to New</option>
              <option value="3" {{$order == 3 ? 'selected' : ''}}>Price,Low to High</option>
              <option value="4" {{$order == 4 ?  'selected' : ''}}>Price, High to Low</option>

            </select>

            <div class="mx-3 shop-asc__seprator bg-light d-none d-md-block order-md-0"></div>

            <div class="order-1 col-size align-items-center d-none d-lg-flex">
              <span class="text-uppercase fw-medium me-2">View</span>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="2">2</button>
              <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="3">3</button>
              <button class="btn-link fw-medium js-cols-size" data-target="products-grid" data-cols="4">4</button>
            </div>

            <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
              <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside" data-aside="shopFilter">
                <svg class="align-middle d-inline-block me-2" width="14" height="10" viewBox="0 0 14 10" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_filter" />
                </svg>
                <span class="align-middle text-uppercase fw-medium d-inline-block">Filter</span>
              </button>
            </div>
          </div>
        </div>

        <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
            @foreach ($products as $product)
            <div class="product-card-wrapper">
                <div class="mb-3 product-card mb-md-4 mb-xxl-5">
                  <div class="pc__img-wrapper">
                    <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                      <div class="swiper-wrapper">
                        <div class="swiper-slide">
                          <a href="{{ route('shop.product.view',['slug'=>$product->slug])}}"><img loading="lazy" src="{{$product->getOrginalIImage}}" width="330"
                              height="400" alt="{{$product->name}}" class="pc__img"></a>
                        </div>
                        @foreach ($product->images as $img )
                           <div class="swiper-slide">
                            <a href="{{ route('shop.product.view',['slug'=>$product->slug])}}"><img loading="lazy" src="{{asset('storage/uploads/products/orginal/'. $img )}}"
                                width="330" height="400" alt="{{$img}}" class="pc__img"></a>

                          </div>
                        @endforeach

                      </div>
                      <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                          xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_prev_sm" />
                        </svg></span>
                      <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                          xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_next_sm" />
                        </svg></span>
                    </div>
                    @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                      <a href="{{route('cart.index')}}" class="mb-3 border-0 btn-warning pc__atc btn anim_appear-bottom position-absolute text-uppercase fw-mediu">Go to Cart</a>
                    @else
                    <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                        @csrf
                        <input type="hidden"  name="id" value="{{$product->id}}"/>
                        <input type="hidden"  name="quantity" value="1"/>
                        <input type="hidden"  name="name" value="{{$product->name}}"/>

                        <input type="hidden"  name="price" value="{{$product->sale_price == ''? $product->regular_price : $product->sale_price}}"/>
                       <button type="submit"
                          class="border-0 pc__atc btn anim_appear-bottom position-absolute text-uppercase fw-medium"
                          data-aside="cartDrawer" title="Add To Cart">Add To Cart
                       </button>
                    </form>
                    @endif
                  </div>

                  <div class="pc__info position-relative">
                    <p class="pc__category">{{$product->category->name}}</p>
                    <h6 class="pc__title"><a href="{{ route('shop.product.view',['slug'=>$product->slug])}}">{{$product->name}}</a></h6>
                    <div class="product-card__price d-flex">
                      <span class="money price">
                        @if ($product->sale_price)
                           <s> ${{$product->regular_price}}</s> ${{$product->sale_price}}
                        @else
                            {{$product->regular_price}}

                        @endif

                    </span>
                    </div>
                    <div class="product-card__review d-flex align-items-center">
                      <div class="reviews-group d-flex">
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                      </div>
                      <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                    </div>

                    @if (Cart::instance('wishlist')->content()->where('id',$product->id)->count()>0)
                    <form action="{{route('wishlist.item.remove',['rowId'=> Cart::instance('wishlist')->content()->where('id',$product->id)->first()->rowId])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="top-0 bg-transparent border-0 pc__btn-wl position-absolute end-0 js-add-wishlist filled-heart"
                            title="Remove from Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{route('wishlist.add')}}">
                        @csrf
                        <input type="hidden"  name="id" value="{{$product->id}}"/>
                        <input type="hidden"  name="name" value="{{$product->name}}"/>
                        <input type="hidden"  name="price" value="{{$product->sale_price == ''? $product->regular_price : $product->sale_price}}"/>
                        <input type="hidden"  name="quantity" value="1"/>

                        <button type="submit" class="top-0 bg-transparent border-0 pc__btn-wl position-absolute end-0 js-add-wishlist"
                            title="Add To Wishlist">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_heart" />
                            </svg>
                        </button>
                    </form>

                    @endif

                  </div>
                </div>
            </div>

            @endforeach


        </div>

        {{-- <nav class="mt-3 shop-pages d-flex justify-content-between" aria-label="Page navigation">
          <a href="#" class="btn-link d-inline-flex align-items-center">
            <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_prev_sm" />
            </svg>
            <span class="fw-medium">PREV</span>
          </a>
          <ul class="mb-0 pagination">
            <li class="page-item"><a class="px-1 mx-2 btn-link btn-link_active" href="#">1</a></li>
            <li class="page-item"><a class="px-1 mx-2 btn-link" href="#">2</a></li>
            <li class="page-item"><a class="px-1 mx-2 btn-link" href="#">3</a></li>
            <li class="page-item"><a class="px-1 mx-2 btn-link" href="#">4</a></li>
          </ul>
          <a href="#" class="btn-link d-inline-flex align-items-center">
            <span class="fw-medium me-1">NEXT</span>
            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_next_sm" />
            </svg>
          </a>
        </nav> --}}

        <div class="divider">
        </div>
        <div class="flex flex-wrap items-center justify-between gap-10 wgp-pagination">
            {{$products->withQueryString()->links('pagination::bootstrap-5')}}

        </div>
      </div>
    </section>
  </main>
  <form id="frmfilter" method="GET" action="{{route('shop.index')}}">
    <input type="hidden" name="page" value="{{$products->currentPage()}}" />
    <input type="hidden" id="size" name="size" value="{{$size}}" />
    <input type="hidden" id="order" name="order" value="{{$order}}" />
    {{-- {{$order}} we added to to save the selected value  --}}
    <input type="hidden" id="hdnBrands" name="brands" value="{{$brandsFilter}}" />
    <input type="hidden" id="hdnCategories" name="categories" value="{{$categoriesFilter}}" />
    <input type="hidden" id="hdnMinPrice" name="min" value="{{$minPrice}}" />
    <input type="hidden" id="hdnMaxPrice" name="max" value="{{$maxPrice}}" />

  </form>

@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('page_size').addEventListener('change', function () {
            document.getElementById('size').value = this.value;
            document.getElementById('frmfilter').submit();
        });

        document.getElementById('orderBy').addEventListener('change', function () {
            document.getElementById('order').value = this.value;
            document.getElementById('frmfilter').submit();
        });

        document.querySelectorAll("input[name='brands']").forEach(function (brandInput) {
            brandInput.addEventListener('change', function () {
                let brands = Array.from(document.querySelectorAll("input[name='brands']:checked"))
                                 .map(input => input.value)
                                 .join(',');

                document.getElementById('hdnBrands').value = brands;
                document.getElementById('frmfilter').submit();
            });
        });

        document.querySelectorAll("input[name='categories']").forEach(function (categoryInput) {
            categoryInput.addEventListener('change', function () {
                let categories = Array.from(document.querySelectorAll("input[name='categories']:checked"))
                                      .map(input => input.value)
                                      .join(',');

                document.getElementById('hdnCategories').value = categories;
                document.getElementById('frmfilter').submit();
            });
        });
        // document.querySelector("input[name='price_range']").addEventListener('input', function() {
        //     var [min, max] = this.value.split(',');

        //     document.getElementById('hdnMinPrice').value = min;
        //     document.getElementById('hdnMaxPrice').value = max;

        //     setTimeout(() => {
        //         document.getElementById('frmfilter').submit();
        //     }, 2000);
        // });
        $("input[name='price_range']").on('change',function(){
            var min = $(this).val().split(',')[0];
            var max = $(this).val().split(',')[1];
            $("#hdnMinPrice").val(min);
            $("#hdnMaxPrice").val(max);
            setTimeout(() => {
                $('#frmfilter').submit();
            }, 2000);

        });


    });



</script>

@endpush
