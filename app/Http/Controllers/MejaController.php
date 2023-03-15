<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MejaController extends Controller
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
        $meja = Meja::all();
        return view('page.meja.index', compact('meja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.meja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        $meja = Meja::where('nomor_meja', $request->nomor_meja)->first();
        if($meja == null) {
            $create = Meja::create($data);
        } else {
            Alert::error('sudah ada meja dengan nomor ini');
            return redirect()->route('meja.index');
        }

        if ($create) {
            return redirect()->route('meja.index');
        } else {
            return redirect()->route('meja.create');
        }
        
    }
    
    public function changeMeja(string $id) 
    { 
        $meja = Meja::where('id', $id)->first();
        return view('page.meja.change', compact('meja'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meja = Meja::where('id', $id)->first();

        return view('page.meja.show', compact('meja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $meja = Meja::where('id', $id)->first();

        return view('page.meja.edit', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $meja = Meja::where('id', $id)->first();
        
        $update = $meja->update([
            'nomor_meja' => $request->nomor_meja,
        ]);
        

        if ($update) {
            return redirect()->route('meja.index');
        } else {
            return redirect()->route('meja.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meja = Meja::where('id', $id)->first();

        $delete = $meja->delete();
        
        return redirect()->route('meja.index');
    }
}
