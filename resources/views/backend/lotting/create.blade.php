@extends('backend.layouts.master')
@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Stock</h5>
        <div class="card-body">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="s_vendor_name">Auction *</span></label>
                    <select class="form-control select2" id="l_auction_id" style="width: 100%;" required>
                        <option hidden disabled selected value>Select Auction</option>
                         @foreach ($auctions as $auction)
                              <option value="{{$auction->id}}" data-auction-venue="{{$auction->venue}}" data-auction-date="{{$auction->date}}" data-auction-time="{{$auction->time}}">{{$auction->auction_no}}</option>
                         @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="l_venue">Venue</label>
		            <input type="text" class="form-control" id="l_venue" placeholder="Venue" disabled>
                </div>
                <div class="form-group">
                    <label for="l_date">Date</label>
		            <input type="text" class="form-control" id="l_date" placeholder="Date" disabled>
                </div>
                <div class="form-group">
                    <label for="l_time">Time</label>
		            <input type="text" class="form-control" id="l_time" placeholder="Address" disabled>
                </div>
                <div class="form-group">
                    <label for="s_vendor_code">Vendor Code</label>
                    <select class="form-control select2" id="s_vendor_code" style="width: 100%;" required disabled>
                        <option selected="selected" disabled>Vendor Code</option>
                        @foreach($vendors_with_stocks as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->vendor_code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="s_vendor_name">Vendor</label>
                    <select class="form-control select2" id="s_vendor_name" style="width: 100%;" required disabled>
                        <option hidden disabled selected value>Select Vendor</option>
                        @foreach($vendors_with_stocks as $vendor)
                            <option value="{{$vendor->id}}">{{$vendor->first_name}} {{$vendor->last_name}}</option>
                        @endforeach
                    </select>
                </div>
				<div class="form-group">
					<label for="l_stocks">STOCKS</label>
					<div class="table-responsive no-padding">
					<table class="table table-hover stocks_table">
						  <tr class="stocks_head">
							<th>S.No</th>
							<th>Form No</th>
							<th>Item No</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Added in Auctions</th>
							<th>Available</th>
							<th>Commission</th>
							<th>Reserve</th>
							<th>Action</th>
						  </tr>
					</table>
				  </div>
			  	</div>
                <input type="hidden" class="confirm_input" id="l_vendor_id" >
		        <input type="hidden" class="confirm_input" id="l_stock_id" >
		        <input type="hidden" class="confirm_input" id="l_vendor_name" >
                    <div class="form-group">
                        <label for="l_vendor_code">Vendor Code</label>
                        <input type="text" class="form-control confirm_input" id="l_vendor_code" placeholder="Vendor Code" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="l_form_no">Form No</label>
                        <input type="text" class="form-control confirm_input" id="l_form_no" placeholder="Form No" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="l_item_no">Item No</label>
                        <input type="text" class="form-control confirm_input" id="l_item_no" placeholder="Item No" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="l_description">Description</label>
                        <input type="text" class="form-control confirm_input" id="l_description" placeholder="Description" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="l_quantity">Quantity</label>
                        <input type="number" class="form-control confirm_input" id="l_quantity" placeholder="Quantity" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="l_reserve">Reserve</label>
                        <input type="number" class="form-control confirm_input" id="l_reserve" placeholder="Reserve" required disabled>
                    </div>
                <div class="form-group">
                    <label for="l_lot_no">Lot No</label>
                    <input type="number" class="form-control confirm_input" id="l_lot_no" placeholder="Lot No" required disabled>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success add_lot" type="submit" disabled>Submit</button>
                </div>
              </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
<script type="text/javascript">

	//CSRF TOKEN HAS BEEN SENT IN HEADER FILE IN APP BLADE
	$('body').on('change','#l_auction_id',function(){
		if($('#s_vendor_code').prop('disabled')==false){
			// $('#s_vendor_code').trigger('change');
		}
		if($('#s_vendor_code').prop('disabled')==true){
			$('#s_vendor_code, #s_vendor_name').prop("disabled", false);
			//Disable Itself after Activating Vendor Section
			$('#l_auction_id').prop("disabled", true);
		}
		var auction_id = $(this).val();
		var auction_venue = $(this).find('option:selected').data('auction-venue');
		var auction_date = $(this).find('option:selected').data('auction-date');
		var auction_time = $(this).find('option:selected').data('auction-time');
		$('#l_venue').val(auction_venue);
		$('#l_date').val(auction_date);
		$('#l_time').val(auction_time);
		$.ajax({
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
	       type:'post',
		   url: '{{ route('get_auction_stocks') }}',
	       dataType: 'json',
	       data:{
				auction_id:auction_id                 
	      	},
	       success:function(data) {
	       	console.log(data);
	       		$(".lot_div").show();
	            $(".lotting_body").remove();
	       		var row_id=1;
	       		var content = '';
	       		data.forEach(rows =>{
	       			// console.log(rows);
	       			var sold = 0;
	       			if (!Array.isArray(rows["sale"]) || !rows["sale"].length) {
					  var delete_button = '<span class="remove_lot"><i class="fa fa-trash" aria-hidden="true"></i></span>'; 
					}
					else{
						var delete_button = '';
						rows["sale"].forEach(sale =>{
							sold += Number(sale['quantity']);
						});
					}
					var left_quantity = Number(rows["quantity"]) - sold;

	       			content += '<tr class="lotting_body" data-vendor-id="'+rows["vendor_id"]+'" data-lotting-id="'+rows["id"]+'">';
	       			content += '<td class="vendor_code" data-row-id="'+row_id+'">'+rows["vendor_code"]+'</td>';
	       			content += '<td class="vendor_name">'+rows["first_name"]+' '+rows["last_name"]+'</td>';
	       			content += '<td class="lot_no">'+rows["lot_no"]+'</td><td class="form_no">'+rows["form_no"]+'</td>';
	       			content += '<td class="item_no">'+rows["item_no"]+'</td>';
	       			content += '<td class="description">'+rows["description"]+'</td>';
	       			content += '<td class="quantity">'+rows["quantity"]+'</td>';
	       			content += '<td class="left_quantity">'+left_quantity+'</td>';
	       			content += '<td class="reserve">'+rows["reserve"]+'</td>';
	       			content += '<td class="sold">'+sold+'</td>';
	       			content += '<td><span class="edit_lot"><i class="fa fa-edit" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;'+delete_button+'</td>';
	       			content += '</tr>';
	       			row_id++;
	       		});
	       		$('.lot_table').append(content);
	       },
	       error:function(data){
	       		$(".lot_div").show();
	       		$(".lotting_body").remove();
	       		$.each(data.responseJSON, function(index, val){
	       			console.log(val);
				});
	       }
	    });
	});
	$('body').on('change','#s_vendor_code',function(){
		var oldval = $('#s_vendor_name').val();
		var newval = this.value;
		var auction_id = $('#l_auction_id').val();
		if(oldval!=newval)
	  		$('#s_vendor_name').val(this.value).trigger('change');
		$.ajax({
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
           type:'post',
           url: '{{ route('get_vendor_stocks') }}',
           dataType: 'json',
           data:{
				id:newval,
				auction_id:auction_id                 
          	},
           	success:function(data) { 
           		console.log(data);
           		$(".l_stocks").show();
           		$(".stocks_body").remove();
           		var length = data['vendor_stocks'].length;
           		var content = '';
           		for(i=0; i<length;i++){
           			var stock_id = data['vendor_stocks'][i]["id"];  			
           			var row_id = i+1;
           			var auction_quantity = 0;
           			if (Array.isArray(data['vendor_stocks'][i]["lotting"]) || data['vendor_stocks'][i]["lotting"].length) {
					  	data['vendor_stocks'][i]["lotting"].forEach(rows =>{
					  		auction_quantity += rows['quantity'];
					  	});
					}
					var available_quantity = data['vendor_stocks'][i]["quantity"] - auction_quantity;

           			content += '<tr class="stocks_body" data-vendor-id="'+data['vendor_stocks'][i]["vendor_id"]+'" data-stock-id="'+stock_id+'">';
           			content += '<td data-row-id="'+row_id+'">'+row_id+'</td>';
           			content += '<td class="form_no">'+data['vendor_stocks'][i]["form_no"]+'</td>';
           			content += '<td class="item_no">'+data['vendor_stocks'][i]["item_no"]+'</td>';
           			content += '<td class="description">'+data['vendor_stocks'][i]["description"]+'</td>';
           			content += '<td class="quantity">'+data['vendor_stocks'][i]["quantity"]+'</td>';
           			content += '<td class="auction_quantity">'+auction_quantity+'</td>';
           			content += '<td class="available_quantity">'+available_quantity+'</td>';
           			content += '<td class="commission">'+data['vendor_stocks'][i]["commission"]+'%</td>';
           			content += '<td class="reserve">'+data['vendor_stocks'][i]["reserve"]+'</td>';
           			content += '<td>'+(data['added_stocks'].includes(stock_id) ? 'Added': '<div class="add_stock"><i class="fa fa-plus-circle" aria-hidden="true"></i></div>')+'</td>';
           			content += '</tr>';
           		}
           		$('.stocks_table').append(content);
           	}
        });
	});

	$('#s_vendor_name').on('change', function(e) {
		e.preventDefault();
		var oldval = $('#s_vendor_code').val();
		var newval = this.value;
		if(oldval!=newval)
	  		$('#s_vendor_code').val(this.value).trigger('change');
	});

	$('body').on('click','.add_stock',function(e){
		e.preventDefault();
    	const vendor_id = $(this).parents('.stocks_body').data('vendor-id');
    	const stock_id = $(this).parents('.stocks_body').data('stock-id');
    	const vendor_code = $('#s_vendor_code option[value="'+vendor_id+'"]').text();
    	const vendor_name = $('#s_vendor_name option[value="'+vendor_id+'"]').text();
    	const row_id = $(this).parents('.stocks_body td').data('row-id');
    	const form_no = $(this).closest('tr').children('td.form_no').text();
    	const item_no = $(this).closest('tr').children('td.item_no').text();
    	const quantity = $(this).closest('tr').children('td.available_quantity').text();
    	const description = $(this).closest('tr').children('td.description').text();
    	const reserve = $(this).closest('tr').children('td.reserve').text();
    	$('#l_vendor_id').val(vendor_id);
    	$('#l_stock_id').val(stock_id);
    	$('#l_vendor_code').val(vendor_code);
    	$('#l_vendor_name').val(vendor_name);
    	$('#l_form_no').val(form_no);
    	$('#l_item_no').val(item_no);
    	$('#l_quantity').val(quantity);
    	$('#l_description').val(description);
    	$('#l_reserve').val(reserve);

    	$('#l_quantity').prop("disabled", false).trigger('change');
    	$('#l_reserve').prop("disabled", false);
	});

	$('body').on('click','.add_lot',function(e){
		e.preventDefault();
		swal({
		  title: "Are you sure?",
		  text: "Please have a check if you are not sure ! ",
		  buttons: true,
		})
		.then((add_lot) => {
		  if (add_lot) {
			var auction_id = $('#l_auction_id').val();
			var vendor_id = $('#l_vendor_id').val();
			var stock_id = $('#l_stock_id').val();
	    	var vendor_code = $('#l_vendor_code').val();
	    	var vendor_name = $('#l_vendor_name').val();
	    	var lot_no = $('#l_lot_no').val();
	    	var form_no = $('#l_form_no').val();
	    	var item_no = $('#l_item_no').val();
	    	var description = $('#l_description').val();
	    	var quantity = $('#l_quantity').val();
	    	var reserve = $('#l_reserve').val();
	    	$.ajax({
				headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  				},
               type:'post',
			   url: '{{ route('save_new_lot') }}',
               dataType: 'json',
               data:{
					auction_id: auction_id,
					vendor_id: vendor_id,
					stock_id: stock_id,
					lot_no: lot_no,
					form_no: form_no,
					item_no: item_no,
					description: description,
					quantity: quantity,
					reserve: reserve                
              	},
               success:function(response) {
               		console.log(response);
               		$('#s_vendor_code').trigger('change');
               		$('.confirm_input').val('');
               		$('.alert-danger').hide();
               		$('.alert-success').show().html('LOT ADDED SUCCESSFULLY');
               		var content = '';
               		content += '<tr class="lotting_body" data-vendor-id="'+vendor_id+'" data-lotting-id="'+response['lotting_id']+'">';
               		content += '<td class="vendor_code">'+vendor_code+'</td>';
               		content += '<td class="vendor_name">'+vendor_name+'</td>';
               		content += '<td class="lot_no">'+lot_no+'</td>';
               		content += '<td class="form_no">'+form_no+'</td>';
               		content += '<td class="item_no">'+item_no+'</td>';
               		content += '<td class="description">'+description+'</td>';
               		content += '<td class="quantity">'+quantity+'</td>';
               		content += '<td class="left_quantity">'+quantity+'</td>';
               		content += '<td class="reserve">'+reserve+'</td>';
               		content += '<td>0</td>';
               		content += '<td><span class="edit_lot"><i class="fa fa-edit" aria-hidden="true"></i></span>&nbsp;&nbsp;&nbsp;';
               		content += '<span class="remove_lot"><i class="fa fa-trash" aria-hidden="true"></i></span></td>';
               		content += '</tr>';

               		$('.lot_table').append(content);
				},
				error: function(response){
					$.each(response.responseJSON, function(index, val){
						// console.log(index+":"+val);
						$('.alert-success').hide();
						$('.alert-danger').show().html(val);
						
					});
				}
            });	
		  } 
		});			
	});

	// Remove Disabled Property from Lot No when Quantity Input has been triggered
	$('#l_quantity').on('change',function(e){
		e.preventDefault();
		$('#l_lot_no').prop("disabled", false);
	});

	// Remove Disabled Property from Add Button when Lot No Input has been triggered
	$('#l_lot_no').on('change keyup',function(e){
		e.preventDefault();
		$('.add_lot').prop("disabled", false);
	});
</script>
@endpush