<?php

namespace App\Http\Controllers\Backend;

use App\Models\Fungsi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FungsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page_title'] = 'Fungsi';
        $data['fungsis'] = Fungsi::orderBy('created_at', 'desc')->get();

        return view('backend.pages.fungsi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_title'] = 'Tambah Data Fungsi';
        return view('backend.pages.fungsi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = new Fungsi();
            $data->fungsi = $request->fungsi;
            $data->save();
                
            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('fungsi');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('fungsi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fungsi $fungsi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Data Fungsi';
        $data['fungsi'] = Fungsi::find($id);
        return view('backend.pages.fungsi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Fungsi::find($id);
            $data->fungsi = $request->fungsi;
            $data->save();
                
            session()->flash('success', 'Data Berhasil Disimpan!');
            return redirect()->route('fungsi');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('fungsi');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Fungsi::find($id);
            $data->delete();
                
            session()->flash('success', 'Data Berhasil Dihapus!');
            return redirect()->route('fungsi');
        } catch (\Throwable $th) {
            session()->flash('failed', $th->getMessage());
            return redirect()->route('fungsi');
        }
    }
}
