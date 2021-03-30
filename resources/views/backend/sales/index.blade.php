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
      <h6 class="m-0 font-weight-bold text-primary float-left">Lists of Lotting</h6>
      <a href="{{route('lotting.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add Vendor"><i class="fas fa-plus"></i> Add Lot</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($lotting)>0)
            <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Vendor Code</th>
                        <th>Item No</th>
                        <th>Form No</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Net Total</th>
                        <th>BP Amount</th>
                        <th>Grand Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lotting as $lot)   
                    <tr>
                        <td>{{ $lot->vendor_code }}</td>
                        <td>{{ $lot->first_name }}{{ $lot->last_name }}</td>
                        <td>{{ $lot->lot_no }}</td>
                        <td>{{ $lot->form_no }}</td>
                        <td>{{ $lot->item_no }}</td>
                        <td>{{ $lot->description }}</td>
                        <td>{{ $lot->quantity }}</td>
                        <td>{{ $lot->quantity }}</td>
                        <td>{{ $lot->reserve }}</td>
                        <td>{{ $lot->sold }}</td>
                        <td>
                            <a href="{{ route('lotting.edit', $lot->id) }}
                                " class="edit_lot">
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
          <h6 class="text-center">No Lotting found!!! Please create Lot</h6>
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