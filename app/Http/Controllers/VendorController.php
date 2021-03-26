<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\State;
use App\Models\Stock;
use App\Models\PaymentMethod;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $vendors = Vendor::with(['stock.lotting.sale'])->get();
        return view('backend.vendors.index',compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        $payment_methods = PaymentMethod::pluck('name');
        return view('backend.vendors.create',compact('states','payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'vendor_code' => 'required|unique:vendors',
            'first_name' => 'required',
            'last_name' => 'required',
            'joined_date' => 'required',
            'gst_status' => 'required',
            'payment_method' => 'required',
            'commission' => 'required',
            'address' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required',
        ]);
        
        $vendor = Vendor::create($request->all());

        return redirect()->route('vendors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vendor = Vendor::where('id' , '=' , $id)->first();
        $states = State::get();
        $payment_methods = PaymentMethod::get();
        return view('backend.vendors.edit',compact('vendor','states','payment_methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        unset($request['_method']);
        unset($request['_token']);
        $update = Vendor::where('id',$id)->update($request->all());
        if($update)
        return redirect()->route('vendors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
