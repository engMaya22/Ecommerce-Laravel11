@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex flex-wrap items-center justify-between gap20 mb-27">
            <h3>All Messages</h3>
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
                    <div class="text-tiny">All Messages</div>
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
                    @if (Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>phone</th>
                                <th>Emial</th>
                                <th>Message</th>
                                <th> Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($contacts as $contact )
                           <tr>
                            <td>{{$contact->id}}</td>
                            <td>{{$contact->name}}</td>
                            <td>{{$contact->phone}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->comment}}</td>
                            <td>{{$contact->created_at}}</td>
                            <td>
                                <div class="list-icon-function">

                                    <form action="{{route('admin.contact.delete',['id'=>$contact->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="item text-danger contact-delete">
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
                {{$contacts->links('pagination::bootstrap-5')}}

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(function(){
        $('.contact-delete').on('click',function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title :'Are you sure',
                text : 'You want to delete it?',
                icon : 'warning',
                buttons : ['No', 'Yes'],
                confirmationButtonColor : '#dc3545'
            }).then(function(result){
                if(result){
                    form.submit();
                }
            })

        })

    });
</script>
@endpush
