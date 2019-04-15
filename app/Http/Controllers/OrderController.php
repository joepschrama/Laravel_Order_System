<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Table;
use App\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->hasRole('admin')) {
            $orders = Order::all();
        } else if(Auth::User()->hasRole('bar')) {
            $orders = [];
            $allOrders = Order::all();
            foreach($allOrders as $order) {
                foreach($order->products as $orderProducts) {
                    if($orderProducts->category->name == 'Dranken') {
                        array_push($orders, $order);
                        break;
                    }
                }
            }
        } else {
            $orders = [];
            $allOrders = Order::all();
            foreach($allOrders as $order) {
                foreach($order->products as $orderProducts) {
                    if($orderProducts->category->name != 'Dranken') {
                        array_push($orders, $order);
                        break;
                    }
                }
            }
        }

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $tables = Table::all();

        return view('order.create', compact('products', 'tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'products' => ['required'],
            'table_nr' => ['required'],
        ]);
        $order = new Order([
            'served' => false,
            'time' => Carbon::now(),
            'table_id' => $data['table_nr'],
            'done' => false,
        ]);
        $order->save();
        
        $products = explode(",", $data['products'][0]);
        foreach($products as $product) {
            $productOrder = new OrderProduct();
            $productOrder->order_id = $order->id;
            $productOrder->product_id = $product;
            $productOrder->save();
        }
        
        return redirect('/order')->with('success', 'Order has been added');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        $tables = Table::all();

        return view('order.edit', compact('order', 'products', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'served' => ['required', 'string', 'max:255'],
            'done' => ['required', 'string', 'max:255'],
            'products' => ['required'],
            'table_nr' => ['required'],
        ]);
        
        $order->served = $data['served'];
        $order->done = $data['done'];
        $order->table_id = $data['table_nr'];
        $order->save();
        
        $products = $data['products'];
        if (isset($products)) {
            $order->products()->detach();
            foreach($products as $product) {
                $productOrder = new OrderProduct();
                $productOrder->order_id = $order->id;
                $productOrder->product_id = $product;
                $productOrder->save();
            }
        }

        // $ordersTable = Table::find(1)->orders;
        // dd($ordersTable);

        return redirect('/order')->with('success', 'Order has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/order')->with('success', 'Order has been deleted');
    }
}
