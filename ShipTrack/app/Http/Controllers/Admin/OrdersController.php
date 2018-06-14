<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;


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
        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('orders/edit', [
            'action' => route('admin-order-create'),
            'order' => new Order()
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


        return view('orders/edit', [
            'action' => route('admin-save-order', ['id' => $id]),
            'order' => $order
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
            'delivery_date',
            'description',
            'type'
        ]));

        $order->save();

        foreach ($request->orderItems as $key => $orderItem) {
            $dbItem = OrderItem::find($key);

            if ($dbItem) {
                $dbItem = new OrderItem();
            }

            $dbItem->order_id = $order->id;

            $dbItem->fill([
                'title' => $orderItem['title'],
                'description' => $orderItem['description'],
                'price' => $orderItem['price']
            ]);

            $dbItem->save();
        }

        return redirect('trucks');
    }
}
