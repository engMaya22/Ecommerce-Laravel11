@extends('layouts.admin')
@section('content')
<style>
    .text-danger {
        font-size: initial;
        line-height: 36px;
    }

    .alert {
        font-size: initial;
    }
</style>

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex flex-wrap items-center justify-between gap20 mb-27">
            <h3>Settings</h3>
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
                    <div class="text-tiny">Settings</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="col-lg-12">
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form  action="{{route('admin.settings.update')}}" method="POST" class="form-new-product form-style-1 needs-validation"
                            novalidate="">
                            @csrf
                            @method('PUT')
                            <fieldset class="name">
                                <div class="body-title">Name <span class="tf-color-1">*</span>
                                </div>
                                <input class="flex-grow" type="text" placeholder="Full Name"
                                    name="name" tabindex="0" value="{{$user->name}}" aria-required="true"
                                    required="" >
                            </fieldset>
                            @error('name')
                            <span class="text-center alert alert-danger">
                               {{$message}}
                            </span>
                            @enderror

                            <fieldset class="name">
                                <div class="body-title">Mobile Number <span
                                        class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Mobile Number"
                                    name="mobile" tabindex="0" value="{{$user->mobile}}" aria-required="true"
                                    required="">
                            </fieldset>
                            @error('mobile')
                            <span class="text-center alert alert-danger">
                               {{$message}}
                            </span>
                            @enderror

                            <fieldset class="name">
                                <div class="body-title">Email Address <span
                                        class="tf-color-1">*</span></div>
                                <input class="flex-grow" type="text" placeholder="Email Address"
                                    name="email" tabindex="0" value="{{$user->email}}" aria-required="true"
                                    required="">
                            </fieldset>
                            @error('email')
                            <span class="text-center alert alert-danger">
                            {{$message}}
                            </span>
                            @enderror

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <h5 class="mb-0 text-uppercase">Password Change</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="pb-3 body-title">Old password
                                        </div>
                                        <input class="flex-grow" type="password"
                                            placeholder="Old password" id="old_password"
                                            name="old_password" value="">

                                    </fieldset>
                                    @error('old_password')
                                            <span class="text-center alert alert-danger">
                                               {{$message}}
                                            </span>
                                    @enderror

                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="pb-3 body-title">New password
                                        </div>
                                        <input class="flex-grow" type="password"
                                            placeholder="New password" id="new_password"
                                            name="new_password"
                                            >

                                    </fieldset>
                                    @error('new_password')
                                    <span class="text-center alert alert-danger">
                                       {{$message}}
                                    </span>
                                    @enderror

                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="pb-3 body-title">Confirm new password
                                        <input class="flex-grow" type="password"
                                            placeholder="Confirm new password" cfpwd=""
                                            data-cf-pwd="#new_password"
                                            id="new_password_confirmation"
                                            name="new_password_confirmation"
                                            >
                                        <div class="invalid-feedback">Passwords did not match!
                                        </div>

                                    </fieldset>
                                    @error('new_password_confirmation')
                                    <span class="text-center alert alert-danger">
                                       {{$message}}
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button type="submit"
                                            class="btn btn-primary tf-button w208">Save
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
