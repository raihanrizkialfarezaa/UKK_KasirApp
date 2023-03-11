<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        return view('page.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['remember_token'] = Str::random(10);
        $data['email_verified_at'] = Date::now();
        $data['gambar'] = $request->file('gambar')->store('uploads/users');

        $user = User::create($data);

        if ($user) {
            if ($request->status === 'admin') {
                $user->assignRole('admin');
                Alert::success('Berhasil Membuat User!', 'Sukses membuat user');
                return redirect()->route('user.index');
            } elseif($request->status === 'manajer') {
                $user->assignRole('manajer');
                Alert::success('Berhasil Membuat User!', 'Sukses membuat user');
                return redirect()->route('user.index');
            } else {
                $user->assignRole('kasir');
                Alert::success('Berhasil Membuat User!', 'Sukses membuat user');
                return redirect()->route('user.index');
            }
        } else {
            Alert::error('Gagal Membuat User!', 'Gagal membuat user');
            return redirect()->route('user.index');
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::where('id', $id)->first();

        return view('page.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();

        return view('page.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();

        if (empty($request->file('gambar'))) {
            if (!empty($request->password)) {
                $update = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            } else {
                $update = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
        } else {
            // dd($request->file('gambar'));
            if (!empty($request->password)) {
                $update = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'gambar' => $request->file('gambar')->store('uploads/users'),
                ]);
                // dd($update);
            } else {
                $update = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'gambar' => $request->file('gambar')->store('uploads/users'),
                ]);
                // dd($update);
            }
        }
        
        

        if ($update) {
            $users = User::where('id', $id)->first();
            $role = $users->roles->pluck('name')[0];
            if ($request->status === 'admin') {
                $users->removeRole($role);
                $users->assignRole('admin');
                Alert::success('Berhasil Mengedit User!', 'Sukses Mengedit user');
                return redirect()->route('user.index');
            } elseif($request->status === 'manajer') {
                $users->removeRole($role);
                $users->assignRole('manajer');
                Alert::success('Berhasil Mengedit User!', 'Sukses Mengedit user');
                return redirect()->route('user.index');
            } else {
                $users->removeRole($role);
                $users->assignRole('kasir');
                Alert::success('Berhasil Mengedit User!', 'Sukses Mengedit user');
                return redirect()->route('user.index');
            }
        } else {
            Alert::error('Gagal Mengedit User!', 'Gagal Mengedit user');
            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->first();

        $delete = $user->delete();

        if ($delete) {
            Alert::success('Sukses menghapus User!', 'Sukses menghapus user');
            return redirect()->route('user.index');
        } else {
            Alert::error('Gagal Menghapus User!', 'Gagal menghapus user');
            return redirect()->route('user.index');
        }
        
    }
}
