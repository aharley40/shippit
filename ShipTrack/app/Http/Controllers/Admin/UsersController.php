<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class usersController extends Controller
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
        $users = User::all();

        return view('users/index', [
            'users' => $users
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = user::find($id);

        return view('users/show', [
            'user' => $user
        ]);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'POST') {
            return $this->save($request, null);
        }

        return view('users/edit', [
            'action' => route('admin-user-create'),
            'user' => new user()
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = user::find($id);


        return view('users/edit', [
            'action' => route('admin-save-user', ['id' => $id]),
            'user' => $user
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        $user = $id ? user::where('id', $id)->first() : new user();

        $user->fill($request->only([
            'name',
            'email',
            'phone',
            'level'
        ]));

    
        $user->save();

        return redirect('users');
    }
}
