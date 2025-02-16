@extends('layouts.admin')
@section('content')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Order Details</h3>
                <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                    <li>
                        <a href="{{route('admin.index')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Order Details</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex flex-wrap items-center justify-between gap10">
                    <div class="flex-grow wg-filter">
                        <h5>Order Details </h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Back</a>
                </div>
                <div class="table-responsive">
                    @if (Session::has('status'))
                        <p class="alert alert-success"> {{ Session::get('status') }}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Order No</th>
                                <td class="text-center">{{$order->id}}</td>

                                <th class="text-center">Mobile</th>
                                <td class="text-center">{{$order->phone}}</td>

                                <th class="text-center">Zip Code</th>
                                <td class="text-center">{{$order->zip}}</td>
                            </tr>
                            <tr>
                                <th class="text-center">Order Date</th>
                                <td class="text-center">{{$order->created_at}}</td>


                                <th class="text-center">Delivered Date</th>
                                <td class="text-center">{{$order->delivered_date}}</td>


                                <th class="text-center">Canceled Date</th>
                                <td class="text-center">{{$order->canceled_date}}</td>

                            </tr>
                            <tr>
                                <th class="text-center">Order Status</th>
                                <td colspan="5">
                                     @if ($order->status === 'delivered')
                                          <span class="badge bg-success" > Delivered </span>

                                     @elseif ($order->status === 'canceled')
                                     <span class="badge bg-danger" > Canceled </span>
                                     @else
                                     <span class="badge bg-warning" > Ordered </span>
                                     @endif


                                </td>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>


            <div class="wg-box">
                <div class="flex flex-wrap items-center justify-between gap10">
                    <div class="flex-grow wg-filter">
                        <h5>Ordered Items</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">SKU</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Brand</th>
                                <th class="text-center">Options</th>
                                <th class="text-center">Return Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ( $items as $item)

                                <tr>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{$item->product->getThumbnailImage}}" alt="{{$item->product->name}}" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="#" target="_blank"
                                                class="body-title-2">{{$item->product->name}}</a>
                                        </div>
                                    </td>
                                    <td class="text-center">${{$item->price}}</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">{{$item->product->sku}}</td>
                                    <td class="text-center">{{$item->product->category->name}}</td>
                                    <td class="text-center">{{$item->product->brand->name}}</td>
                                    <td class="text-center">{{$item->options}}</td>
                                    <td class="text-center">{{$item->rstatus == 0 ? "No" : "Yes"}}</td>
                                    <td class="text-center">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                          @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{$items->links('pagination::bootstrap-5')}}

                </div>

            </div>


            <div class="mt-5 wg-box">
                <h5>Shipping Address</h5>
                <div class="my-account__address-item col-md-6">
                    <div class="my-account__address-item__detail">
                        <p>{{$order->name}}</p>
                        <p>{{$order->address}}</p>
                        <p>{{$order->locality}}</p>
                        <p>{{$order->city}},{{$order->country}} </p>
                        <p>{{$order->landmark}}</p>
                        <p>{{$order->zip}}</p>
                        <br>
                        <p>Mobile : {{$order->phone}}</p>
                    </div>
                </div>
            </div>

            <div class="mt-5 wg-box">
                <h5>Update Order Status</h5>
                <form action="{{route('admin.order.update')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <div class="row">
                        <div class="col-md-3">
                           <div class="select">
                            <select name="status" id="order_status">
                                <option value="ordered" {{$order->status === 'ordered' ? 'selected': ""}}>Ordered</option>
                                <option value="delivered" {{$order->status === 'delivered' ? 'selected': ""}}>Delivered</option>
                                <option value="canceled" {{$order->status === 'canceled' ? 'selected': ""}}>Canceled</option>

                             </select>
                           </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary tf-button w208d">
                               Update Status
                            </button>
                        </div>
                    </div>

                </form>

            </div>

            <div class="mt-5 wg-box">
                <h5>Transactions</h5>
                <table class="table table-striped table-bordered table-transaction">
                    <tbody>
                        <tr>
                            <th>Subtotal</th>
                            <td>{{$order->subtotal}}</td>
                            <th>Tax</th>
                            <td>{{$order->tax}}</td>
                            <th>Discount</th>
                            <td>{{$order->discount}}</td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{$order->total}}</td>
                            <th>Payment Mode</th>
                            <td>{{$transaction?->mode}}</td>
                            <th>Status</th>
                            <td>
                                @if ($transaction?->status === 'approved')
                                <span class="badge bg-success" > Approved </span>

                                @elseif ($transaction?->status === 'declined')
                                <span class="badge bg-danger" > Declined </span>
                                @elseif ($transaction?->status === 'refunded')
                                <span class="badge bg-secondary" > Refunded </span>
                                @else
                                <span class="badge bg-warning" > Pending </span>
                                @endif
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
