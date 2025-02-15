@extends('layouts.app')
@section('content')

<style>
    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .625rem !important;
      background-color: #6a6e51 !important;
    }

    .table>tr>td {
      padding: 0.625rem 1.5rem .625rem !important;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }

    .table> :not(caption)>tr>td {
      padding: .8rem 1rem !important;
    }
    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
   </style>

    <main class="pt-90" style="padding-top: 0px;">
        <div class="pb-4 mb-4"></div>
        <section class="container my-account">
            <h2 class="page-title">Order Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('user.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="mt-5 mb-5 wg-box">
                        <div class="row">
                          <div class="col-6">
                            <h5>Ordered Details</h5>
                          </div>
                          <div class="text-right col-6">
                            <a class="btn btn-sm btn-danger" href="{{route('user.orders')}}">Back</a>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tbody>
                              <tr>
                                <th>Order No</th>
                                <td>{{$order->id}}</td>
                                <th>Mobile</th>
                                <td>{{$order->phone}}</td>
                                <th>Zip Code</th>
                                <td>{{$order->zip}}</td>
                              </tr>
                              <tr>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Delivered Date</th>
                                <td>{{$order->delivered_date}}</td>
                                <th>Canceled Date</th>
                                <td>{{$order->canceled_date}}</td>
                              </tr>
                              <tr>
                                <th>Order Status</th>
                                <td colspan="5">
                                    @if ($order->status === 'ordered')
                                    <span class="badge bg-primary">Ordered</span>
                                    @elseif ($order->status === 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                    @else
                                   <span class="badge bg-danger">Canceled</span>
                                    @endif
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>

                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                          <div class="col-6">
                            <h5>Ordered Items</h5>
                          </div>
                          <div class="text-right col-6">

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
                      </div>
                      <div class="divider"></div>
                      <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">

                      </div>

                      <div class="mt-5 wg-box">
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                           <div class="my-account__address-item__detail">
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
                        <h5>Transactions</h5>
                        <div class="table-responsive">
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

                      <div class="mt-5 text-right wg-box">
                        <form action="http://localhost:8000/account-order/cancel-order" method="POST">
                          <input type="hidden" name="_token" value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT" autocomplete="off">
                          <input type="hidden" name="_method" value="PUT"> <input type="hidden" name="order_id" value="1">
                          <button type="submit" class="btn btn-danger">Cancel Order</button>
                        </form>
                      </div>

                </div>

            </div>
        </section>
    </main>


@endsection
