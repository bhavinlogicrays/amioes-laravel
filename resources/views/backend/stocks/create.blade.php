@extends('backend.layouts.master')

@php
	$fields = [
		'Form No *' => [
			'name' 	=> 'form_no',
			'id' 	=> 's_form_no',
			'type' 	=> 'text',
			'col' 	=> '2',
		],
		'Commission *' 	=> [
			'name' 	=> 'commission',
			'id'   	=> 's_commission',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
		'Item Number *' => [
			'name' 	=> 'item_no',
			'id' 	=> 's_item_no',
			'type' 	=> 'text',
			'col' 	=> '2',
		],
		'Quantity' => [
			'name' 	=> 'quantity',
			'id' 	=> 's_quantity',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
		'Reserve' => [
			'name' 	=> 'reserve',
			'id' 	=> 's_reserve',
			'type' 	=> 'number',
			'col' 	=> '2',
		],
	];
@endphp

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Stock</h5>
        <div class="card-body">
            <form method="post" action="{{route('stocks.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="vendor_id">Vendor Code *</span></label>
                    <select name="vendor_id" class="form-control select2" id="s_vendor_code" required>
                        <option selected="selected" disabled>Vendor Code</option>
                        @foreach($vendors as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="s_vendor_name">Vendor Code *</span></label>
                    <select class="form-control select2" id="s_vendor_name" required>
                        <option selected="selected" disabled>Select Vendor</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->first_name }} {{ $vendor->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="form_no">Form No*
                    </label>
                    <div class="input-group form_no">
                        <input type="text" name="form_no" class="form-control" id="form_no" placeholder="Form No">
                        @error('form_no')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="commission">Commission*
                    </label>
                    <div class="input-group commission">
                        <input type="number" name="commission" class="form-control" id="commission" placeholder="Commission">
                        @error('commission')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="item_no">Item No*
                    </label>
                    <div class="input-group item_no">
                        <input type="text" name="item_no" class="form-control" id="item_no" placeholder="Item No">
                        @error('item_no')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity*
                    </label>
                    <div class="input-group quantity">
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity">
                        @error('quantity')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="reserve">Reserve*
                    </label>
                    <div class="input-group reserve">
                        <input type="number" name="reserve" class="form-control" id="reserve" placeholder="Reserve">
                        @error('reserve')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea name="description" id="" cols="10" rows="3" class="form-control"></textarea>
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
<script type="text/javascript">
	$('#s_vendor_code').on('change', function() {
		var oldval = $('#s_vendor_name').val();
		var newval = this.value;
		if(oldval!=newval)
			$('#s_vendor_name').val(this.value).trigger('change');
	});
	$('#s_vendor_name').on('change', function() {
		var oldval = $('#s_vendor_code').val();
		var newval = this.value;
		if(oldval!=newval)
			$('#s_vendor_code').val(this.value).trigger('change');
	});
</script>
@endpush