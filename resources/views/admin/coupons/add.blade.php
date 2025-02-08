@extends('layouts.admin')
@section('content')

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex flex-wrap items-center justify-between gap20 mb-27">
                <h3>Coupon infomation</h3>
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
                        <a href="{{route('admin.coupons')}}">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{route('admin.coupon.store')}}">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Code" name="code"
                            tabindex="0" value="{{old('code')}}" aria-required="true" required="">
                    </fieldset>
                    @error('code')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror
                    <fieldset class="category">
                        <div class="body-title">Coupon Type
                            <span class="tf-color-1">*</span>
                        </div>
                        <div class="flex-grow select">
                            <select class="" name="type" required="">
                                <option  value="">Select</option>
                                <option  {{old('type') == 'fixed' ? 'selected' : ''}} value="fixed">Fixed</option>
                                <option {{old('type') == 'percent' ? 'selected' : ''}} value="percent">Percent</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('type')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Value" name="value"
                            tabindex="0" value="{{old('value')}}" aria-required="true" required="">
                    </fieldset>
                    @error('value')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Cart Value"
                            name="cart_value" tabindex="0" value="{{old('cart_value')}}" aria-required="true"
                            required="">
                    </fieldset>
                    @error('cart_value')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="date" placeholder="Expiry Date"
                            name="expire_at" tabindex="0" value="{{old('expire_at')}}" aria-required="true"
                            required="">
                    </fieldset>
                    @error('expire_at')
                    <span class="text-center alert alert-danger">
                       {{$message}}
                    </span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
