<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Yajra\Datatables\Datatables;

class KategoriBerita extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('berita.kategori');
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
        if($request->name==null){
            \Session::flash('alert-class','alert-danger');
            return redirect('kategori')->with('message','Nama Kategori Tidak Boleh Kosong');
        }

        $kat=new Kategori(array(
            'name' => $request->name,
            'slug' => str_slug($request->nama)
        ));

        $kat->save();
        \Session::flash('alert-class','alert-success');
        return redirect('kategori')->with('message','Berhasil Menyimpan Kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $kats=Kategori::all();
        return Datatables::of($kats)
        ->addColumn('action',function($kat){
            return '<a href="" class="btn btn-warning" data-toggle="modal" data-target="#updatekat" data-kat_id="'.$kat->id.'" data-kat_name="'.$kat->name.'"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;<a class="btn btn-danger" data-toggle="modal" data-target="#deletekat" data-kat_id="'.$kat->id.'"><i class="fa fa-btn fa-trash"></i></a>';
        })
        ->addIndexColumn()->make('true');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->name==null){
            \Session::flash('alert-class','alert-danger');
            return redirect('kategori')->with('message','Nama Kategori Tidak Boleh Kosong');
        }

        $kat=Kategori::find($id);
        $kat->update([
            'name' => $request->name,
            'slug' => str_slug($request->slug)
        ]);

        \Session::flash('alert-class','alert-success');
        return redirect('kategori')->with('message','Berhasil Menyimpan Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kat=Kategori::find($id);
        $kat->delete();

        \Session::flash('alert-class','alert-success');
        return redirect('kategori')->with('message','Berhasil Menghapus');
    }
}
