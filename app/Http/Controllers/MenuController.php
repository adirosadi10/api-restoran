<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Menu::all();
        $data = DB::table('menus')
            ->join('kategoris', 'kategoris.idKategori', '=', 'menus.idKategori')
            ->select('menus.*', 'kategoris.kategori')
            ->orderBy('menus.menu','asc')
            ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request,[
            'idKategori' => 'required|numeric',
            'menu' => 'required|unique:menus',
            'gambar' => 'required',
            'harga' => 'required|numeric',
        ]);
        $gambar = $request->file('gambar')->getClientOriginalName();
        $request->file('gambar')->move('upload',$gambar) ;
        $data = [
            'idKategori' => $request->input('idKategori'),
            'menu' => $request->input('menu'),
            'gambar' => url('upload/'.$gambar),
            'harga' => $request->input('harga'),
        ];
        $menu = Menu::create($data);
        if($menu) {
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
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('menus')
        ->join('kategoris', 'kategoris.idKategori', '=', 'menus.idKategori')
        ->select('menus.*', 'kategoris.kategori')
        ->where('idMenu','=',$id)
        ->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'idKategori' => 'required|numeric',
            'menu' => 'required',
            'harga' => 'required|numeric',
        ]);
        if ($request -> hasFile('gambar')) {
            $gambar = $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('upload',$gambar) ;
            $data = [
                'idKategori' => $request->input('idKategori'),
                'menu' => $request->input('menu'),
                'gambar' => url('upload/'.$gambar),
                'harga' => $request->input('harga'),
            ];
        } else {
            $data = [
                'idKategori' => $request->input('idKategori'),
                'menu' => $request->input('menu'),
                'harga' => $request->input('harga'),
            ];
        }
        $menu = Menu::where('idMenu', $id)->update($data);
        if ($menu) {
    
            return response()->json([
                'pesan' => "Data berhasil update"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where('idMenu', $id)->delete();
        if ($menu) {
            return response()->json([
                'pesan' => 'Data berhasil dihapus'
            ]);
        }
    }
}
