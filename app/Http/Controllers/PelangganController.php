<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelanggan::paginate(10);
        return response()->json($data);
        
    }
    // simplePaginate(10)
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request,[
            'pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required|numeric',
        ]);
        $pelanggan = Pelanggan::create($request->all());
        if($pelanggan){
            return response()->json([
                'pesan' => 'Data berhasil disimpan'
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pelanggan::where('idPelanggan', $id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $pelanggan = Pelanggan::where('idPelanggan', $id)->update($request->all());
        if($pelanggan){
            return response()->json([
                'pesan' => "data telah update"
            ]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::where('idPelanggan', $id)->delete();
        if($pelanggan){
            return response()->json([
                'pesan' => 'data berhasil dihapus'
            ]);
        }
    }
}
