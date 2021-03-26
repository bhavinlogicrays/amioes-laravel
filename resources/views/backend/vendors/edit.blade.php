@extends('backend.layouts.master')

@php
	$gst_status = ['inclusive', 'exclusive'];

	$fields = [
		'GST Status *' => [
			'name'	=> 'gst_status',
			'id'	=> 'v_gst_status',
			'type'	=> 'select',
			'var'		=> 'gst_status',
			'col' 	=> '3',
			'req' 	=> true,
		],
	];
@endphp
    {{-- {{ dd($vendor) }} --}}
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Vendor</h5>
        <div class="card-body">
            <form method="post" action="{{route('vendors.update',$vendor->id)}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="vendor_code">Vendor Code *
                    </label>
                    <div class="input-group v_code">
                        <input type="text" name="vendor_code" class="form-control" id="vendor_code" placeholder="Vendor Code" value="{{ $vendor->vendor_code }}">
                        @error('vendor_code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name *
                    </label>
                    <div class="input-group first_name">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{ $vendor->first_name }}">
                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name *
                    </label>
                    <div class="input-group last_name">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{ $vendor->last_name }}">
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="company">Company *
                    </label>
                    <div class="input-group company">
                        <input type="text" name="company" class="form-control" id="company" placeholder="Comapny" value="{{ $vendor->company }}">
                        @error('company')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address *
                    </label>
                    <div class="input-group address">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ $vendor->address }}">
                        @error('address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="suburb">Suburb *
                    </label>
                    <div class="input-group suburb">
                        <input type="text" name="suburb" class="form-control" id="suburb" placeholder="Suburb" value="{{ $vendor->suburb }}">
                        @error('suburb')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="state">State *</span></label>
                    <select name="state" class="form-control">
                        <option value="">--Select any State--</option>
                        @foreach($states as $key=>$data)
                            <option value='{{$data->name}}' {{(($data->id==$vendor->id)? 'selected' : '')}}>{{$data->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode *
                    </label>
                    <div class="input-group postcode">
                        <input type="text" name="postcode" class="form-control" id="postcode" placeholder="postcode" value="{{ $vendor->postcode }}">
                        @error('postcode')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile *
                    </label>
                    <div class="input-group mobile">
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="mobile" value="{{ $vendor->mobile }}">
                        @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="joined_date">Joined Date *
                    </label>
                    <div class="input-group joined_date">
                        <input type="date" name="joined_date" class="form-control" id="joined_date" placeholder="joined_date" value="{{ $vendor->joined_date }}">
                        @error('joined_date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="ac_no">A/C No *
                    </label>
                    <div class="input-group ac_no">
                        <input type="text" name="ac_no" class="form-control" id="ac_no" placeholder="ac_no" value="{{ $vendor->ac_no }}">
                        @error('ac_no')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="bsb_no">BSB No *
                    </label>
                    <div class="input-group bsb_no">
                        <input type="text" name="bsb_no" class="form-control" id="bsb_no" placeholder="bsb_no" value="{{ $vendor->bsb_no }}">
                        @error('bsb_no')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="abn">ABN *
                    </label>
                    <div class="input-group abn">
                        <input type="text" name="abn" class="form-control" id="abn" placeholder="abn" value="{{ $vendor->abn }}">
                        @error('abn')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="gst_status">GST Status *</span></label>
                    <select name="gst_status" class="form-control">
                        @foreach($gst_status as $gst_status_name)
                            <option value='{{ $gst_status_name }}' {{(( $gst_status_name==$vendor->gst_status )? 'selected' : '')}}>{{ $gst_status_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method *</span></label>
                    <select name="payment_method" class="form-control">
                        <option value="">--Select any Payment Method--</option>
                        @foreach($payment_methods as $payment_method)
                            <option value='{{ $payment_method->name }}' {{(( $payment_method->id==$vendor->id )? 'selected' : '')}}>{{ $payment_method->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="commission">Commission *
                    </label>
                    <div class="input-group commission">
                        <input type="number" name="commission" class="form-control" id="commission" placeholder=Commission" value="{{ $vendor->commission }}">
                        @error('commission')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea name="comments" id="" cols="10" rows="3" class="form-control">{{ $vendor->comments }}</textarea>
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