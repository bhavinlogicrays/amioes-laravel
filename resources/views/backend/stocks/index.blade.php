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
      <h6 class="m-0 font-weight-bold text-primary float-left">Lists of Stock</h6>
      <a href="{{route('stocks.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Vendor"><i class="fas fa-plus"></i> Add Stock</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($stocks)>0)
            <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                    <th>S.No</th>
                    <th>Vendor Code</th>
                    <th>Form No</th>
                    <th>Item No</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Reserve</th>
                    <th>Sold</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $stock)   
                    <tr>
                        <td>{{ $stock->id }}</td>
                        <td>{{ $stock->vendor_code }}</td>
                        <td>{{ $stock->form_no }}</td>
                        <td>{{ $stock->item_no }}</td>
                        <td>{{ $stock->description }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->reserve }}</td>
                        <td>{{ $stock->sold }}</td>
                        <td>
                            <a href="{{ route('stocks.edit',$stock->id) }}
                                " class="edit_stock">
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
          <h6 class="text-center">No Stocks found!!! Please create Stock</h6>
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