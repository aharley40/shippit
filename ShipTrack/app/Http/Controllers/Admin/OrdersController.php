<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Client;
use App\Models\OrderItem;


class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders/index', [
            'orders' => $orders
        ]);
    }

    public function show(Request $request, $id)
    {
        $order = Order::find($id);

        return view('orders/show', [
            'order' => $order
        ]);
    }

    public function create(Request $request)
    {
        $clients = Client::all();

        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('orders/edit', [
            'action' => route('admin-order-create'),
            'order' => new Order(),
            'orderItems' => [],
            'clients' => $clients
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $order = Order::find($id);
        $clients = Client::all();

        $orderItems = OrderItem::where('order_id', $id)
        ->get();

        // var_dump($order);
        // die('hello');

        return view('orders/edit', [
            'action' => route('admin-save-order', ['id' => $id]),
            'order' => $order,
            'clients' => $clients,
            'orderItems' => $orderItems
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $order = $id ? Order::where('id', $id)->first() : new Order();
        $primary_address_id = null;



        $order->fill($request->only([
            'client_id',
            'description',
            'type'
        ]));
        $order->delivery_date = date('Y-m-d g:i:s',strtotime($request->delivery_date));

        $order->save();

        foreach ($request->orderItems as $key => $orderItem) {
            $dbItem = OrderItem::find($key);

            if (!$dbItem) {
                $dbItem = new OrderItem();
            }

            $dbItem->fill($orderItem);
            $dbItem->order_id = $order->id;

            $dbItem->save();

            $dbItem->fill([
                'title' => $orderItem['title'],
                'description' => $orderItem['description'],
                'price' => $orderItem['price']
            ]);

            $dbItem->save();
        }

        return redirect('orders');
    }
}
