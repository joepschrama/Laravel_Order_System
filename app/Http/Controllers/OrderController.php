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
        $orders = [];
        $allOrders = Order::all();
        if(Auth::User()->hasRole('admin')) {
            $filter = 'admin';
        } else if(Auth::User()->hasRole('bar')) {
            $filter = 'bar';
        } else {
            $filter = 'kok';
        }
        $arrayProducts = [];
        if($filter != 'admin') {
            foreach($allOrders as $order) {
                foreach($order->products as $orderProducts) {
                    if($filter == 'bar') {
                        if($orderProducts->category->name == 'Dranken') {
                            array_push($arrayProducts, $order->products);
                            array_push($orders, $order);
                            break;
                        }
                    } else if($filter == 'kok') {
                        if($orderProducts->category->name != 'Dranken') {
                            array_push($arrayProducts, $order->products);
                            array_push($orders, $order);
                            break;
                        }
                    }
                }
            }
        } else {
            foreach($allOrders as $order) {
                array_push($arrayProducts, $order->products);
                array_push($orders, $order);
            }
        }

        $allProducts = [];
        $productCounts = [];
        foreach($arrayProducts as $arrayProduct) {
            $productNames = [];
            $allProductsArray = [];
            $productCountsArray = [];
            for($i = 0; $i < count($arrayProduct); $i++) {
                if($filter == 'bar') {
                    if($arrayProduct[$i]->category->name == 'Dranken') {
                        array_push($productNames, $arrayProduct[$i]->name);
                    }
                } else if($filter == 'kok') {
                    if($arrayProduct[$i]->category->name != 'Dranken') {
                        array_push($productNames, $arrayProduct[$i]->name);
                    }
                } else {
                    array_push($productNames, $arrayProduct[$i]->name);
                }
            }

            $productNamesArray = array_count_values($productNames);
            foreach($productNamesArray as $key => $productName) {
                $pieces = explode("=>", $productName);
                array_push($productCountsArray, $pieces[0]);
                array_push($allProductsArray, $key);
            }
            array_push($productCounts, $productCountsArray);
            array_push($allProducts, $allProductsArray);
        }

        return view('order.index', compact('orders', 'allProducts', 'productCounts'));
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

        $order = new Order;
        $order->served = false;
        $order->time = Carbon::now();
        $order->done_kok = false;
        $order->done_bar = false;
        $order->table_id = $data['table_nr'];
        $order->save();

        $products = explode(",", $data['products']);
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
        $order->done_kok = $data['done'];
        $order->done_bar = false;
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
    
    public function orderReady(Request $request)
    {
        $data = $request->validate([
            'orderId' => 'required',
            'role' => 'required'
        ]);
        
        $order = Order::find($data['orderId']);
        if($data['role'] == 'admin') {
            $order->done_kok = 1;
            $order->done_bar = 1;
        } else {
            if($data['role'] == 'kok') {
                $order->done_kok = 1;
            } else {
                $order->done_bar = 1;
            }
        }
        $order->save();
    }
    
    public function getData()
    {
//         $orders = [];
//         $allOrders = Order::all();
//         if(Auth::User()->hasRole('admin')) {
//             $filter = 'admin';
//         } else if(Auth::User()->hasRole('bar')) {
//             $filter = 'bar';
//         } else {
//             $filter = 'kok';
//         }
//         $arrayProducts = [];
//         if($filter != 'admin') {
//             foreach($allOrders as $order) {
//                 foreach($order->products as $orderProducts) {
//                     if($filter == 'bar') {
//                         if($orderProducts->category->name == 'Dranken') {
//                             array_push($arrayProducts, $order->products);
//                             array_push($orders, $order);
//                             break;
//                         }
//                     } else if($filter == 'kok') {
//                         if($orderProducts->category->name != 'Dranken') {
//                             array_push($arrayProducts, $order->products);
//                             array_push($orders, $order);
//                             break;
//                         }
//                     }
//                 }
//             }
//         } else {
//             foreach($allOrders as $order) {
//                 array_push($arrayProducts, $order->products);
//                 array_push($orders, $order);
//             }
//         }

//         $allProducts = [];
//         $productCounts = [];
//         foreach($arrayProducts as $arrayProduct) {
//             $productNames = [];
//             $allProductsArray = [];
//             $productCountsArray = [];
//             for($i = 0; $i < count($arrayProduct); $i++) {
//                 if($filter == 'bar') {
//                     if($arrayProduct[$i]->category->name == 'Dranken') {
//                         array_push($productNames, $arrayProduct[$i]->name);
//                     }
//                 } else if($filter == 'kok') {
//                     if($arrayProduct[$i]->category->name != 'Dranken') {
//                         array_push($productNames, $arrayProduct[$i]->name);
//                     }
//                 } else {
//                     array_push($productNames, $arrayProduct[$i]->name);
//                 }
//             }

//             $productNamesArray = array_count_values($productNames);
//             foreach($productNamesArray as $key => $productName) {
//                 $pieces = explode("=>", $productName);
//                 array_push($productCountsArray, $pieces[0]);
// //                $orders['amount'] = $pieces[0];
//                 array_push($allProductsArray, $key);
//             }
//             array_push($productCounts, $productCountsArray);
//             array_push($allProducts, $allProductsArray);
//         }
        $user = Auth::User();
        if($user->hasRole('admin')) {
            $orders = Order::all();
        } else if($user->hasRole('ober')) {
            $order = Order::where('done_kok', true)->orWhere('done_bar', true);
        } else if($user->hasRole('kok')) {
            $order = Order::where('done_kok', false);
        } else {
            $order = Order::where('done_bar', false);
        }


        foreach($orders as $order) {
            $order->table;
            $order->products;
            foreach($order->products as $key => $product) {
                
            }
        }
        return response()->json($orders);
    }
}
