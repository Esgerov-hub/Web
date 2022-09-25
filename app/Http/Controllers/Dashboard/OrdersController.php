<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Exception;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:orders-view|orders-create|orders-edit|orders-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:orders-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:orders-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:orders-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $orders = Orders::orderBy('id','DESC')->get();

            return view('dashboard.orders.index',compact('orders'));            
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            $order = null;

            return view('dashboard.orders.create_edit',compact('order'));            
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $order)
    {
        try
        {

            return view('dashboard.orders.show',compact('order'));            
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $order)
    {
        try
        {

            return view('dashboard.orders.create_edit',compact('order'));            
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $order)
    {
        try
        {
            $order->delete();

            return redirect()->back()->with('success','Məlumatınız ləvğ edildi.');            
        }catch(Exception $e)
        {
            return redirect()->back()->with('error',$e->getMessage());
        }    
    }


    public function recycle()
    {
        try{
            $orders = Orders::orderBy('id','DESC')->onlyTrashed()->get();
           
            return view('dashboard.orders.recycle',compact('orders'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Orders $order,$id)
    {
        try {
            $orders = Orders::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
