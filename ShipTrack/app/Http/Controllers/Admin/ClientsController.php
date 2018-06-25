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
            'client' => new Client(),
            'addresses' => []
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
        $addresses = Address::where('client_id', $id)
            // ->join('addresses', 'clients.primary_address_id', '=', 'addresses.id')
            // ->select('clients.primary_address_id')
            ->get();

        return view('clients/edit', [
            'action' => route('admin-save-client', ['id' => $id]),
            'client' => $client,
            'addresses' => $addresses
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
        $client->save();
        $savedAddressIDs = [];

        foreach ($request->addresses as $key => $address) {
            $dbAddress = Address::find($key);

            if (!$dbAddress) {
                $dbAddress = new Address();
            }

            $dbAddress->fill($address);
            $dbAddress->client_id = $client->id;

            $dbAddress->save();
            $savedAddressIDs[] = $dbAddress->id;

            if ($request->primary_address) {

                if (substr($request->primary_address, 0,3) == 'new') {
                    $primary_address_id = $dbAddress->id;
                } else {
                    $primary_address_id = $request->primary_address;
                }
            }
        }

        $deletionIds = Address::where('client_id', $client->id)
            ->whereNotIn('id', $savedAddressIDs)
            ->pluck('id');

        Address::whereIn('id', $deletionIds)->delete();

        $client->primary_address_id = $primary_address_id;
        $client->save();

        return redirect('clients');
    }
}
