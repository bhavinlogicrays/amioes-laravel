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
      <h6 class="m-0 font-weight-bold text-primary float-left">Auctions Lists</h6>
      <a href="{{route('auctions.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add Auction</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($auctions)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Auction No.</th>
              <th>Venue</th>
              <th>Date</th>
              <th>Time</th>
              <th>Stocks</th>
            </tr>
          </thead>
          <tbody>
                @foreach($auctions as $auction)   
                <tr>
                    <td>{{$auction->auction_no}}</td>
                    <td>{{$auction->venue}}</td>
                    <td>{{$auction->date}}</td>
                    <td>{{$auction->time}}</td>
                    <td>
                        @if(count($auction->lottings))
                            <a href="#" data-toggle="modal" data-target="#auction_stocks_{{$auction->id}}">
                            <i class="fa fa-dot-circle-o"></i>
                            </a>
                            {{-- Modal Popup --}}
                        <div class="modal fade auction_stocks_modal" id="auction_stocks_{{$auction->id}}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">{{$auction->auction_no}} Stocks</h4>
                                </div>
                                <div class="modal-body">
                                <table class="table table-hover buyer_purchases_table datatable_with_print" data-buyer-id="{{$auction->id}}">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Vendor Code</th>
                                        <th>Form No</th>
                                        <th>Item No</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Sold</th>
                                        <th>Left</th>
                                    </tr>
                                    </thead>
                                    @php 
                                        $count = 1;
                                    @endphp
                                    <tbody>
                                    @foreach($auction->lottings as $stock)
                                    @php
                                        $sold = 0; 
                                        if(count($stock->sale)){
                                        foreach($stock->sale as $sale){
                                            $sold += $sale->quantity;
                                        }
                                        }
                                    @endphp
                                    
                                        <tr>
                                        <td>{{$count}}</td>
                                        <td class="vendor_code">{{$stock->vendor->vendor_code}}</td>
                                        <td class="form_no">{{$stock->form_no}}</td>
                                        <td class="item_no">{{$stock->item_no}}</td>
                                        <td class="description">{{$stock->description}}</td>
                                        <td class="quantity">{{$stock->quantity}}</td>
                                        <td class="sold">{{$sold}}</td>
                                        <td class="left_quantity">{{$stock->quantity - $sold}}</td>
                                        </tr>
                                    
                                        @php 
                                        $count++; 
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            </div>
                        </div>
                        @else
                        <a href="#" data-auction-id="{{$auction->id}}" class="delete_auction">
                            <i class="fa fa-trash"></i>
                        </a>
                        @endif
                    <td>
                </tr>  
                @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No Auctions found!!! Please create Auctions</h6>
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

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>      
  <script src="{{ asset('backend/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('backend/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('backend/js/buttons.print.min.js') }}"></script>
  <script type="text/javascript">
    $('.delete_auction').on('click',function(e){
      e.preventDefault();
      const me = $(this);
      swal({
        title: "Are you sure?",
        text: "Once deleted, this item will be removed from the invoice",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          const auction_id = $(this).data('auction-id');
          $.ajax({
            type:'DELETE',
            url: SITE_URL + 'auctions/' + auction_id,
            dataType: 'json',
            data:{
              auction_id: auction_id,    
            },
            success:function(data) {
              console.log(data)
              swal("Deleted!", {
                icon: "success",
              });
              me.parent().parent().remove();
              // location.reload();
              
            },
            error: function(response){
            }
          });
        } 
      });
    })

    $(document).ready(function() {
      $('.datatable_with_print').DataTable( {
          dom: 'Bfrtip',
          buttons: [
            {
              extend: 'print',
              title: '',
              customize: function(win) {
                $(win.document.body).css('font-size', '5pt');
                $(win.document.body).css('margin', '0px');
                $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
              }
            }
          ],

      });
    });
  </script>
@endpush