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
      <h6 class="m-0 font-weight-bold text-primary float-left">Vendor of Lists</h6>
      <a href="{{route('vendors.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Vendor"><i class="fas fa-plus"></i> Add Vendor</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($vendors)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Vendor Code</th>
              <th>Vendor Name</th>
              <th>Mobile</th>
              <th>Joined Date</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
                @foreach($vendors as $vendor)   
                    <tr>
                        <td>{{ $vendor->vendor_code }}</td>
                        <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                        <td>{{ $vendor->mobile }}</td>
                        <td><span class="label bg-purple">{{$vendor->joined_date}}</span></td>
                        <td>{{$vendor->address}}</td>
                        <td>
                            <a href="{{ route('vendors.edit',$vendor->id) }}
                                " class="edit_vendor">
                                <span class="action_icons">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </span>
                            </a>
                            @if(count($vendor->stock))
                                <a href="#" data-toggle="modal" data-target="#vendor_stocks_{{$vendor->id}}">
                                    <i class="fa fa-dot-circle-o"></i>
                                </a>
                                <div class="modal fade vendor_stocks_modal" id="vendor_stocks_{{$vendor->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Stocks</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Form No</th>
                                                        <th>Item No</th>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Left</th>
                                                        <th>Reserve</th>
                                                        <th>Sold</th>
                                                    </tr>
                                                    @php 
                                                        $count = 1; 
                                                    @endphp
                                                    @foreach($vendor->stock as $stock)
                                                    @php 
                                                        $total_sales = 0; 
                                                        if(count($stock->lotting)){
                                                            foreach($stock->lotting as $lotting){
                                                                if(count($lotting->sale)){
                                                                    foreach($lotting->sale as $sale){
                                                                        $total_sales += $sale->quantity;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>{{$count}}</td>
                                                        <td>{{$stock->form_no}}</td>
                                                        <td>{{$stock->item_no}}</td>
                                                        <td>{{$stock->description}}</td>
                                                        <td>{{$stock->quantity}}</td>
                                                        <td>{{$stock->quantity - $total_sales}}</td>
                                                        <td>{{$stock->reserve}}</td>
                                                        <td>{{$total_sales}}</td>
                                                    </tr>
                                                        @php  
                                                            $count++; 
                                                        @endphp
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    {{-- @php
                        $c++;
                    @endphp   --}}
                @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No vendors found!!! Please create vendor</h6>
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