<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Address;


class AddressesController extends Controller
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
        $addresses = Address::all();

        return view('addresses/index', [
            'addresses' => $addresses
        ]);
    }

    public function show(Request $request, $id)
    {
        $address = Address::find($id);

        return view('addresses/show', [
            'address' => $address
        ]);
    }

    public function create(Request $request)
    {   
        $clients = Client::all();
        $addresses = Address::all();
        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('addresses/edit', [
            'action' => route('admin-address-create'),
            'address' => new Address(),
            'clients' => $cliets
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $address = Address::find($id);
        $clients = Client::all();

        return view('addresses/edit', [
            'action' => route('admin-save-address', ['id' => $id]),
            'address' => $address,
            'clients' => $clients
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $address = $id ? Address::where('id', $id)->first() : new Address();
        //$primary_address_id = null;

        $address->fill($request->only([
            'title',
            'address_2',
            'lat',
            'lng'
        ]));

        // foreach ($request->addresses as $key => $address) {
        //     $dbAddress = Address::find($key);

        //     if ($dbAddress) {
        //         $dbAddress = new Address();
        //     }

        //     $dbAddress->fill([
        //         'title',
        //         'address_1',
        //         'address_2',
        //         'city',
        //         'state',
        //         'postal'
        //     ]);

        //     $dbAddress->save();

        //     if ($address->primary_address) {
        //         $primary_address_id = $address->primary_address;
        //     }
        // }

        // $client->primary_address_id = $primary_address_id;
        $address->save();

        return redirect('addresses');
    }
}
