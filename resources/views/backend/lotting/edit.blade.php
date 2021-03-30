@extends('backend.layouts.master')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Stock</h5>
        <div class="card-body">
            <form method="post" action="{{route('lotting.update',$lotting_edit->id)}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="auction">Auction
                    </label>
                    <div class="input-group auction">
                        <input type="text" class="form-control" id="auction" value="{{$lotting_edit->auction_no}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="venue">Venue
                    </label>
                    <div class="input-group venue">
                        <input type="text" name="venue" class="form-control" id="venue" value="{{$lotting_edit->venue}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date">Date
                    </label>
                    <div class="input-group date">
                        <input type="text" name="date" class="form-control" id="date" value="{{$lotting_edit->date}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="time">Time
                    </label>
                    <div class="input-group time">
                        <input type="text" name="time" class="form-control" id="time" value="{{$lotting_edit->time}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vendor_code">Vendor Code
                    </label>
                    <div class="input-group vendor_code">
                        <input type="text" name="vendor_code" class="form-control" id="vendor_code" value="{{$lotting_edit->vendor_code}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="vendor">Vendor
                    </label>
                    <div class="input-group vendor">
                        <input type="text" name="vendor" class="form-control" id="vendor" value="{{$lotting_edit->first_name}} {{$lotting_edit->last_name}} " disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="form_no">Form No</label>
                    <input type="text" name="form_no" class="form-control" id="form_no" value="{{$lotting_edit->form_no}}" disabled>
                </div>
                <div class="form-group">
                    <label for="item_no">Item No</label>
                    <input type="text" name="item_no" class="form-control" id="item_no" value="{{$lotting_edit->item_no}}" disabled>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description" value="{{$lotting_edit->description}}" disabled>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity*</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" value="{{$lotting_edit->quantity}}">
                </div>
                <div class="form-group">
                    <label for="reserve">Reserve*</label>
                    <input type="number" name="reserve" class="form-control" id="reserve" value="{{$lotting_edit->reserve}}">
                </div>
                <div class="form-group">
                    <label for="lot_no">Lot No</label>
                    <input type="text" name="lot_no" class="form-control" id="lot_no" value="{{$lotting_edit->lot_no}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
    <script src="{{ asset('backend/js/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript">
        $('.timepicker').timepicker({
        showInputs: false
        });
    </script>
@endpush