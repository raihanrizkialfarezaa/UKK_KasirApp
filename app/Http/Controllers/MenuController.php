<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
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
        $menu = Menu::all();
        return view('page.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['gambar'] = $request->file('gambar')->store('uploads/menu');
        $create = Menu::create($data);

        if ($create) {
            Alert::success('Sukses', 'Berhasil Membuat Menu');
            return redirect()->route('menu.index');
        } else {
            Alert::error('Gagal', 'gagal membuat menu');
            return redirect()->route('menu.create');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::where('id', $id)->first();

        return view('page.menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::where('id', $id)->first();

        return view('page.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::where('id', $id)->first();
        if (empty($request->file('gambar'))) {
            $update = $menu->update([
                'nama_menu' => $request->nama_menu,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
            ]);
        } else {
            Storage::delete($menu->gambar);
            $update = $menu->update([
                'nama_menu' => $request->nama_menu,
                'jenis' => $request->jenis,
                'deskripsi' => $request->deskripsi,
                'gambar' => $request->file('gambar')->store('uploads/menu'),
                'harga' => $request->harga,
            ]);
        }
        

        if ($update) {
            Alert::success('Sukses', 'Berhasil Mengedit Menu');
            return redirect()->route('menu.index');
        } else {
            Alert::success('Gagal', 'Gagal mengedit Menu');
            return redirect()->route('menu.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::where('id', $id)->first();

        $delete = $menu->delete();
        
        return redirect()->route('menu.index');
    }
}
