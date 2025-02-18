@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex flex-wrap items-center justify-between gap20 mb-27">
            <h3>Users</h3>
            <ul class="flex flex-wrap items-center justify-start breadcrumbs gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All User</div>
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

            </div>
            <div class="wg-table table-all-user">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th class="text-center">Total Orders</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user )
                            <tr>
                                <td>{{$user->id}}</td>
                                <td class="pname">
                                    {{-- <div class="image">
                                        <img src="user-1.html" alt="" class="image">
                                    </div> --}}
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{$user->name}}</a>
                                        <div class="mt-3 text-tiny">{{$user->type}}</div>
                                    </div>
                                </td>
                                <td>{{$user->mobile}}</td>
                                <td>{{$user->email}}</td>
                                <td class="text-center"><a href="#" target="_blank">{{$user->orders->count()}}</a></td>
                                {{-- <td>
                                    <div class="list-icon-function">
                                        <a href="#">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                    </div>
                                </td> --}}
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="divider"></div>
            <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">

            </div>
        </div>
    </div>
</div>
@endsection
