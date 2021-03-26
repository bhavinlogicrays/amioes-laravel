@extends('backend.layouts.master')
@section('main-content')
<div class="card">
    <h5 class="card-header">Add Auctions</h5>
    <div class="card-body">
        <form method="post" action="{{route('auctions.store')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="a_venue">Venue</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <input type="text" name="venue" class="form-control" id="a_venue" placeholder="Enter Venue">
                    @error('venue')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="a_date">Date</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i> 
                    </div>
                    <input type="date" name="date" class="form-control" id="a_date" placeholder=" Date">
                    @error('date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <label>Time picker:</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock"></i> 
                        </div>
                        <input type="text" name="time" class="form-control timepicker">
                        @error('time')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
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