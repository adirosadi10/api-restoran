<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show($a, $b)
    {
        $data = DB::table('details')
            ->join('orders', 'orders.idOrder', '=', 'details.idOrder')
            ->join('menus', 'menus.idMenu', '=', 'details.idMenu')
            ->join('pelanggans', 'pelanggans.idPelanggan', '=', 'orders.idPelanggan')
            ->join('kategoris', 'kategoris.idkategori', '=', 'menus.idkategori')
            ->select('details.*', 'orders.*', 'menus.*', 'pelanggans.*', 'kategoris.*')
            ->where('tglOrder', '>=', $a)
            ->where('tglOrder', '<=', $b)
            ->orderBy('orders.tglOrder','asc')
            ->get();    
        
            return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        //
    }
}
