@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Lists of Buyers</h6>
      <a href="{{route('buyers.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Buyer"><i class="fas fa-plus"></i> Add Buyer</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($buyers)>0)
            <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>Buyer Code</th>
                    <th>Buyer Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Comments</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buyers as $buyer)   
                    <tr>
                        <td>{{ $buyer->buyer_code }}</td>
                        <td>{{ $buyer->first_name }} {{ $buyer->last_name }}</td>
                        <td>{{ $buyer->address }}</td>
                        <td>{{ $buyer->mobile }}</td>
                        <td>{{ $buyer->comments }}</td>
                        <td>
                            <a href="{{ route('buyers.edit',$buyer->id) }}
                                " class="edit_buyer">
                                <span class="action_icons">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
          <h6 class="text-center">No Buyers found!!! Please create Buyer</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

@endpush