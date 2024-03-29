<?php

namespace App\Http\Controllers;
use App\Models\Vendor;
use App\Models\Stock;


use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::select('id','vendor_code','first_name','last_name')->get();
        $stocks = Stock::select(
            'stocks.id',
            'stocks.form_no',
            'stocks.item_no',
            'stocks.description',
            'stocks.quantity',
            'stocks.reserve',
            'stocks.sold',
            'vendors.vendor_code',
            'vendors.first_name','vendors.last_name',)
            ->join('vendors','stocks.vendor_id','=','vendors.id')
            ->with('lotting.sale')
            ->get();
        // return $stocks;
        return view('backend.stocks.index',compact('vendors','stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::select('id','vendor_code','first_name','last_name')->get();
        $stocks = Stock::select(
                                'stocks.id',
                                'stocks.form_no',
                                'stocks.item_no',
                                'stocks.description',
                                'stocks.quantity',
                                'stocks.reserve',
                                'vendors.vendor_code')
                            ->join('vendors','stocks.vendor_id','=','vendors.id')
                            ->with('lotting.sale')
                            ->get();
        return view('backend.stocks.create',compact('vendors','stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'vendor_id' => 'required',
            'commission' => 'required',
            'form_no' => 'required',
            'item_no' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'reserve' => 'required',
        ]);

        //Check for Existing form_no and item_no
        $exists_forms_with_items = Stock::where('vendor_id','=',$request->vendor_id)->where('form_no','=',$request->form_no)->where('item_no','=',$request->item_no)->exists();
        
        if($exists_forms_with_items)
            return back()->withErrors('Form no and Item no exists already');
        
        $stock = Stock::create($request->all());

        return redirect(route('stocks.index'))->with('message','Stocks Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $stocks = Stock::select(
                                'stocks.id',
                                'stocks.form_no',
                                'stocks.item_no',
                                'stocks.description',
                                'stocks.commission',
                                'stocks.quantity',
                                'stocks.reserve',
                                'vendors.vendor_code')
                            ->join('vendors','stocks.vendor_id','=','vendors.id')
                            ->where('stocks.id',$id)
                            ->first();
        return view('backend.stocks.edit',compact('stocks'));

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
        $validatedData = $request->validate([
            'form_no' => 'required',
            'item_no' => 'required',
            'commission' => 'required',
            'quantity' => 'required',
            'reserve' => 'required',
            'description' => 'required'
        ]);
        $stocks = Stock::where('id',$id)
                       ->update(['form_no' => $request->form_no,
                                'item_no' => $request->item_no,
                                'commission' => $request->commission,
                                'quantity' => $request->quantity,
                                'reserve' => $request->reserve,
                                'description' => $request->description,
                                 ]);
        return redirect(route('stocks.index'))->with('message','Stocks Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }
}
