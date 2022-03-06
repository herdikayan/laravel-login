<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data User';
        $data['q'] = $request->q;
        $data['rows'] = User::where('nama_user', 'like', '%' . $request->q . '%')->get();
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['title'] = 'Tambah User';
        $data['levels'] = ['admin' => 'Admin', 'user' => 'User'];
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required|unique:tb_user',
            'password' => 'required',
            'level' => 'required',
        ]);

        $user = new User();
        $user->nama_user = $request->nama_user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect('user')->with('success', 'Tambah Data Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['title'] = 'Ubah User';
        $data['row'] = $user;
        $data['levels'] = ['admin' => 'Admin', 'user' => 'User'];
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required',
            'level' => 'required',
        ]);

        $user->nama_user = $request->nama_user;
        $user->email = $request->email;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect('user')->with('success', 'Ubah Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('user')->with('success', 'Hapus Data Berhasil');
    }
}
