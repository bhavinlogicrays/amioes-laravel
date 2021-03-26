@extends('backend.layouts.master')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Stock</h5>
        <div class="card-body">
            <form method="post" action="{{route('lotting.update',$lot->id)}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="s_vendor_code">Vendor Code*
                    </label>
                    <div class="input-group s_vendor_code">
                        <input type="text" class="form-control" id="s_vendor_code" value="{{$stocks ?? ''->vendor_code}}" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="form_no">Form No*
                    </label>
                    <div class="input-group form_no">
                        <input type="text" name="form_no" class="form-control" id="form_no" value="{{$stocks ?? ''->form_no}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="commission">Commission*
                    </label>
                    <div class="input-group commission">
                        <input type="text" name="commission" class="form-control" id="commission" value="{{$stocks ?? ''->commission}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="item_no">Item Number*
                    </label>
                    <div class="input-group item_no">
                        <input type="text" name="item_no" class="form-control" id="item_no" value="{{$stocks ?? ''->item_no}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity*
                    </label>
                    <div class="input-group quantity">
                        <input type="number" name="quantity" class="form-control" id="quantity" value="{{$stocks ?? ''->quantity}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="reserve">Reserve*
                    </label>
                    <div class="input-group reserve">
                        <input type="number" name="reserve" class="form-control" id="reserve" value="{{$stocks ?? ''->reserve}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="" cols="10" rows="3" class="form-control">{{ $vendor->description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Submit</button>
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