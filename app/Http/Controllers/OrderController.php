<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $order = Order::all();
        return view('order.create',collect('order'));
    }

    public function myorders(){
        $orders = Order::where('user_id', '=', auth()->user()->id)->get();

    
        return view('userorders',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       


        $data['user_id'] = auth()->user()->id;
        $data['date'] = date('Y-m-d');
        $data['status'] = 'Pending';
        $carts = Cart::where('user_id', auth()->user()->id)->where('is_ordered',false)->get();
        $totalamount = 0;
        foreach($carts as $cart) {
            $total = $cart->product->price * $cart->qty;
            $totalamount += $total;
        }
        $data['grand_amount'] = $totalamount;
        $ids = $carts->pluck('id')->toArray();
        $data['cart_id'] = implode(',', $ids);

        dd($data);
        Order::create($data);
        Cart::whereIn('id', $ids)->update(['is_ordered' => true]);



        return redirect()->route('order.myorders');
      

        


       
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

   
    
}
