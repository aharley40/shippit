<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Truck;


class TrucksController extends Controller
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
        $trucks = Truck::all();

        return view('trucks/index', [
            'trucks' => $trucks
        ]);
    }

    public function show(Request $request, $id)
    {
        $truck = Truck::find($id);

        return view('trucks/show', [
            'truck' => $truck
        ]);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('trucks/edit', [
            'action' => route('admin-truck-create'),
            'truck' => new Truck()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $truck = Truck::find($id);


        return view('trucks/edit', [
            'action' => route('admin-save-truck', ['id' => $id]),
            'truck' => $truck
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $truck = $id ? Truck::where('id', $id)->first() : new Truck();

        $truck->fill($request->only([
            'title',
            'vin',
            'license_plate',
            'insurance_provider',
            'insurance_number',
            'registration_number',
            'state_registered'
        ]));

        $truck->save();

        return redirect('trucks');
    }
}
