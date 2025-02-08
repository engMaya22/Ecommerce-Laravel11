@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex flex-wrap items-center justify-between gap20 mb-27">
            <h3>Coupons</h3>
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
                    <div class="text-tiny">Coupons</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex flex-wrap items-center justify-between gap10">
                <div class="flex-grow wg-filter">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.coupon.add')}}"><i
                        class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    @if (Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Cart Value</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($coupons as $coupon )
                           <tr>
                            <td>{{$coupon->id}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>{{$coupon->type}}</td>
                            <td>{{$coupon->value}}</td>
                            <td>{{$coupon->cart_value}}</td>
                            <td>{{$coupon->expire_at}}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{route('admin.coupon.edit',['id'=>$coupon->id])}}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="#" method="POST">
                                        <div class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </div>
                                    </form>
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
                {{$coupons->links('pagination::bootstrap-5')}}

            </div>
        </div>
    </div>
</div>

@endsection
