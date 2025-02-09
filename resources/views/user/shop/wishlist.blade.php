@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="pb-4 mb-4"></div>
    <section class="container shop-checkout">
      <h2 class="page-title">Wishlist</h2>

      <div class="shopping-cart">
        @if ($items->count()>0)
        <div class="cart-table__wrapper">
            <table class="cart-table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ( $items as $item )
                    <tr>
                        <td>
                        <div class="shopping-cart__product-item">
                            <img loading="lazy" src="{{asset('storage/uploads/products/thumbnails/'.$item->model->main_image)}}" width="120" height="120" alt="{{$item->name}}" />
                        </div>
                        </td>
                        <td>
                        <div class="shopping-cart__product-item__detail">
                            <h4>{{$item->name}}</h4>
                            {{-- <ul class="shopping-cart__product-item__options">
                            <li>Color: Yellow</li>
                            <li>Size: L</li>
                            </ul> --}}
                        </div>
                        </td>
                        <td>
                        <span class="shopping-cart__product-price">${{$item->price}}</span>
                        </td>
                        <td>
                        {{$item->qty}}
                        </td>

                        <td>
                         <div class="row">
                            <div class="col-6">
                                <form action="{{route('wishlist.move.to.cart',['rowId'=>$item->rowId])}}" method="POST" id="wishlist-form">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        Move to Cart
                                    </button>
                                </form>
                               </div>
                               <div class="col-6">
                                <form action="{{route('wishlist.item.remove',['rowId'=>$item->rowId])}}" method="POST" id="wishlist-form">
                                    @csrf
                                    @method('DELETE')
                                   <a href="javascript:void(0)" class="remove-cart" onclick="document.getElementById('wishlist-form').submit();">
                                       <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                       <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                       </svg>
                                   </a>
                               </form>

                               </div>
                         </div>


                        </td>
                    </tr>
                  @endforeach


                </tbody>
            </table>
            <div class="cart-table-footer">

                <form action="{{route('wishlist.empty')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light">Clear Wishlist</button>
                </form>
            </div>
        </div>

        @else
            <div class="row">
            <div class="pt-5 pb-5 col-md-12">
                <p>
                    No items found in your wishlist
                    <a href="{{route('wishlist.index')}}" class=" btn btn-info">shop now</a>
                </p>
            </div>
            </div>

        @endif

      </div>
    </section>
  </main>
@endsection
