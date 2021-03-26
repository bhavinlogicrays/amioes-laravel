@extends('backend.layouts.master')

@php
	$gst_status = ['inclusive', 'exclusive'];

	$fields = [
		'Vendor Code *' => [
			'name'	=> 'vendor_code',
			'id'	=> 'v_vendor_code',
			'type'	=> 'text',
			'col' 	=> '2',
			'req' 	=> true,
		],
		'First Name *' => [
			'name'	=> 'first_name',
			'id'	=> 'v_first_name',
			'type'	=> 'text',
			'col' 	=> '3',
			'req' 	=> true,
		],
		'Last Name *' => [
			'name'	=> 'last_name',
			'id'	=> 'v_last_name',
			'type'	=> 'text',
			'col' 	=> '4',
			'req' 	=> true,
		],
		'Company Name' => [
			'name'	=> 'company',
			'id'	=> 'v_company',
			'type'	=> 'text',
			'col' 	=> '3',
			'req' 	=> true,
		],
		'Address *' => [
			'name'	=> 'address',
			'id'	=> 'v_address',
			'type'	=> 'text',
			'col' 	=> '4',
			'req' 	=> true,
		],
		'Suburb *' => [
			'name'	=> 'suburb',
			'id'	=> 'v_suburb',
			'type'	=> 'text',
			'col' 	=> '2',
			'req' 	=> true,
		],
		'State *' => [
			'name'	=> 'state',
			'id'	=> 'v_state',
			'type'	=> 'select',
			'var'	=> 'states',
			'col' 	=> '2',
			'req' 	=> true,
		],
		'Postcode *' => [
			'name'	=> 'postcode',
			'id'	=> 'v_postcode',
			'type'	=> 'number',
			'col' 	=> '4',
			'req' 	=> true,
		],
		'Mobile' => [
			'name'	=> 'mobile',
			'id'	=> 'v_mobile',
			'type'	=> 'text',
			'col' 	=> '4',
			'req' 	=> false,
		],
		'Email' => [
			'name'	=> 'email',
			'id'	=> 'v_email',
			'type'	=> 'email',
			'col' 	=> '4',
			'req' 	=> false,
		],
		'Joined Date' => [
			'name'	=> 'joined_date',
			'id'	=> 'v_joined_date',
			'type'	=> 'date',
			'col' 	=> '4',
			'req' 	=> true,
		],
		'A/C No' => [
			'name'	=> 'a/c_no',
			'id'	=> 'v_account_no',
			'type'	=> 'text',
			'col' 	=> '6',
			'req' 	=> false,
		],
		'BSB No' => [
			'name'	=> 'bsb_no',
			'id'	=> 'v_bsb_no',
			'type'	=> 'text',
			'col' 	=> '6',
			'req' 	=> false,
		],
		'ABN' => [
			'name'	=> 'abn',
			'id'	=> 'v_abn',
			'type'	=> 'text',
			'col' 	=> '3',
			'req' 	=> false,
		],
		'GST Status *' => [
			'name'	=> 'gst_status',
			'id'	=> 'v_gst_status',
			'type'	=> 'select',
			'var'		=> 'gst_status',
			'col' 	=> '3',
			'req' 	=> true,
		],
		'Payment Method *' => [
			'name'	=> 'payment_method',
			'id'	=> 'v_payment_method',
			'type'	=> 'select',
			'var'	=> 'payment_methods',
			'col' 	=> '3',
			'req' 	=> true,
		],
		'Commission *' => [
			'name'	=> 'commission',
			'id'	=> 'v_commission',
			'type'	=> 'number',
			'col' 	=> '3',
			'req' 	=> true,
		],
		'Comments' => [
			'name'	=> 'comments',
			'id'	=> 'v_comments',
			'type'	=> 'textarea',
			'col' 	=> '12',
			'req' 	=> true,
		],
	];
@endphp

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Vendor</h5>
        <div class="card-body">
            <form method="post" action="{{route('vendors.store')}}">
                {{csrf_field()}}
                @foreach($fields as $f_name => $part)
                    <div class="col-md-{{$part['col']}}">
                        <div class="form-group">
                            <label for="{{$part['id']}}">{{$f_name}}</label>
                            @if($part['type']=='text' || $part['type']=='number' || $part['type']=='email' || $part['type']=='date')
                            <div class="input-group">
                                <input type="{{$part['type']}}" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="Enter {{$f_name}}" @if($part['req']) required @endif>
                            </div>
                            @elseif($part['type']=='select')
                                <div class="input-group">
                                    <select name="{{$part['name']}}" class="form-control select2" id="{{$part['id']}}" style="width: 100%;" @if($part['req']) required @endif>
                                    <option hidden disabled selected value>Select {{$f_name}}</option>
                                        @foreach(${$part['var']} as $data)
                                            @if($part['name']=='state')
                                                <option value="{{$data->name}}">{{$data->name}}</option>
                                            @elseif($part['name']=='gst_status' || $part['name']=='payment_method')
                                                <option value="{{$data}}">{{ucfirst($data)}}</option>
                                            @endif
                                        @endforeach 
                                    </select>
                                </div>
                            @elseif($part['type']=='textarea')
                                <div class="input-group">
                                    <textarea type="text" name="{{$part['name']}}" class="form-control" id="{{$part['id']}}" placeholder="{{$f_name}}"></textarea>
                                </div>
                            @endif
                        </div>
                    </div>
				@endforeach
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