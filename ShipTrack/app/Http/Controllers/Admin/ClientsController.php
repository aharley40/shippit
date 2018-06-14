<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Address;


class ClientsController extends Controller
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
        $clients = Client::all();

        return view('clients/index', [
            'clients' => $clients
        ]);
    }

    public function show(Request $request, $id)
    {
        $client = Client::find($id);

        return view('clients/show', [
            'client' => $client
        ]);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('clients/edit', [
            'action' => route('admin-client-create'),
            'client' => new Client()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $client = Client::find($id);


        return view('clients/edit', [
            'action' => route('admin-save-client', ['id' => $id]),
            'client' => $client
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $client = $id ? Client::where('id', $id)->first() : new Client();
        $primary_address_id = null;

        $client->fill($request->only([
            'name',
            'email',
            'phone'
        ]));

        foreach ($request->addresses as $key => $address) {
            $dbAddress = Address::find($key);

            if ($dbAddress) {
                $dbAddress = new Address();
            }

            $dbAddress->fill([
                'title',
                'address_1',
                'address_2',
                'city',
                'state',
                'postal'
            ]);

            $dbAddress->save();

            if ($address->primary_address) {
                $primary_address_id = $address->primary_address;
            }
        }

        $client->primary_address_id = $primary_address_id;
        $client->save();

        return redirect('trucks');
    }
}
