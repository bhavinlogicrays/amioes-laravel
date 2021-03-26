@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Stock</h5>
        <div class="card-body">
            <form method="post" action="{{route('buyers.store')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="buyer_code">Buyer Code*
                    </label>
                    <div class="input-group buyer_code">
                        <input type="text" name="buyer_code" class="form-control" id="buyer_code" placeholder="Buyer Code">
                        @error('buyer_code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name*
                    </label>
                    <div class="input-group first_name">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name*
                    </label>
                    <div class="input-group last_name">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="company">Company*
                    </label>
                    <div class="input-group company">
                        <input type="text" name="company" class="form-control" id="company" placeholder="Company">
                        @error('company')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address*
                    </label>
                    <div class="input-group address">
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                        @error('address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="Suburb">Suburb*
                    </label>
                    <div class="input-group suburb">
                        <input type="text" name="suburb" class="form-control" id="suburb" placeholder="Suburb">
                        @error('suburb')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_vendor_name">State *</span></label>
                    <select name="state" class="form-control select2" id="s_vendor_name" required>
                        <option selected="selected" disabled>Select State*</option>
                        @foreach($states as $state)
                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="postcode">Postcode*
                    </label>
                    <div class="input-group postcode">
                        <input type="number" name="postcode" class="form-control" id="postcode" placeholder="Postcode">
                        @error('postcode')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile*
                    </label>
                    <div class="input-group mobile">
                        <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile">
                        @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email*
                    </label>
                    <div class="input-group email">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="comments">Comments*</label>
                    <textarea name="comments" id="" cols="10" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="b_buyers_premium">Buyers Premium*</label>
                    <label>Yes
                        <input type="radio" class="b_buyers_premium_yes" value="1" name="buyers_premium" onclick="show1();">
                    </label>
                    <label>No
                        <input type="radio" class="b_buyers_premium_no" value="2" name="buyers_premium" onclick="hide1();" checked>
                    </label>
                </div>
                <div class="form-group b_buyers_premium_rate" style="display: none;">
                    <label for="b_buyers_premium_rate">Buyers Premium Rate*</label>
                    <input type="number" name="buyers_premium_rate" class="form-control" id="b_buyers_premium_rate" placeholder="Buyers Premium Rate" >
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
	function show1(){
        $('.b_buyers_premium_rate').show();
    }
    function hide1(){
        $('.b_buyers_premium_rate').hide();
    }
</script>
@endpush