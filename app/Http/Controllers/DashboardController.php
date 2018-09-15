<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visimisi;
use App\Kontak;
use App\Kategorifasilitas;
use Yajra\Datatables\Datatables;
use App\Fasilitas;
use Storage;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $kontak=Kontak::first();
        if($kontak==null){
            $data=new Kontak(array(
                'telp' => $request->telp,
                'email' => $request->email,
                'fax' => $request->fax,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'alamat' => $request->alamat,
            ));

            $data->save();
        }else{
            $kontak->update([
                'telp' => $request->telp,
                'email' => $request->email,
                'fax' => $request->fax,
                'facebook' => $request->facebook,
                'youtube' => $request->youtube,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'alamat' => $request->alamat,
            ]);
        }

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menyimpan Kontak');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visi=Visimisi::first();
        if ($visi==null) {
            $data=new Visimisi(array(
                'visi' => $request->visi,
                'misi' => $request->misi,
                'motto' => $request->motto,
                'sejarah' => $request->sejarah,
            ));

            $data->save();
        }else{
            $visi->update([
                'visi' => $request->visi,
                'misi' => $request->misi,
                'motto' => $request->motto,
                'sejarah' => $request->sejarah,
            ]);
        }

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menyimpan Visi Misi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data=Visimisi::first();
        return view('visimisi.frmvisimisi',compact('data'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function kontak()
    {
        $data=Kontak::first();
        return view('kontak.frmkontak',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showdashfas()
    {
        return view('fasilitas.kategori');
    }

    public function showkategorifasilitas()
    {
        $katfas=Kategorifasilitas::all();
        return Datatables::of($katfas)
        ->addColumn('action',function($kat){
            return '<a href="" class="btn btn-warning" data-toggle="modal" data-target="#updatekatfas" data-kat_id="'.$kat->id.'" data-kategori="'.$kat->kategori.'"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;<a class="btn btn-danger" data-toggle="modal" data-target="#deletekatfas" data-kat_id="'.$kat->id.'"><i class="fa fa-btn fa-trash"></i></a>';
        })
        ->addIndexColumn()->make('true');
    }

    public function addkatfas(Request $req)
    {
        if($req->kategori==null){
            \Session::flash('alert-class','alert-danger');
            return redirect()->back()->with('message','Kategori Harus Diisi');
        }

        $katfas=new Kategorifasilitas(array(
            'kategori' => $req->kategori,
        ));
        $katfas->save();

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menyimpan Data');
    }

    public function updatekatfas(Request $request,$kat_id)
    {
        $kat=Kategorifasilitas::find($kat_id);
        $kat->update([
            'kategori' => $request->kategori
        ]);
        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Merubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kat=Kategorifasilitas::find($id); 
        $kat->delete();
        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menghapus Data');
    }

    public function showfasilitas()
    {
        $kat=Kategorifasilitas::all(); 
        return view('fasilitas.fasilitas',compact('kat'));
    }

    public function getfasilitas()
    {
        $fas=Fasilitas::all();
        return Datatables::of($fas)->addColumn('action',function($f){
            return '<a href="" class="btn btn-warning" id="tbupdate" data-toggle="modal" data-target="#fasmodalupdate" data-fas_id="'.$f->id.'" data-nama="'.$f->nama.'" data-foto="'.$f->foto.'" data-kategori_fasilitas="'.$f->kategorifasilitas_id.'"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;<a class="btn btn-danger" data-toggle="modal" data-target="#deletefas" data-fas_id="'.$f->id.'"><i class="fa fa-btn fa-trash"></i></a>';
        })->addIndexColumn()->make('true');
    }

    public function createfasilitas(Request $req)
    {
        if($req->nama==null || $req->kategori_fasilitas==null){
            \Session::flash('alert-class','alert-danger');
            return redirect()->back()->with('message','Data Nama dan Kategori Tidak Boleh Kosong');
        }

        $storage=Storage::disk('fasilitas');
        if($req->foto!==null){
            $name='';
            $file=$req->foto;
            $fileext=$file->getClientOriginalExtension();
            $filename=$file->getClientOriginalName();
            $new=str_random(20);
            $name=$new.".".$fileext;
            $storage->putFileAs('fasilitas',$file,$name);

            $fas=new Fasilitas(array(
                'nama' => $req->nama,
                'kategorifasilitas_id' => $req->kategori_fasilitas,
                'foto' => $name,
                'slug' => str_slug($req->nama)
            ));
            $fas->save();
        }else{
            $fas=new Fasilitas(array(
                'nama' => $req->nama,
                'slug' => str_slug($req->nama),
                'kategorifasilitas_id' => $req->kategori_fasilitas
            ));
            $fas->save();
        }

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menyimpan Data');
    }

    public function updatefasilitas(Request $req,$id)
    {
        if($req->nama==null || $req->kategori_fasilitas==null){
            \Session::flash('alert-class','alert-danger');
            return redirect()->back()->with('message','Data Nama dan Kategori Tidak Boleh Kosong');
        }

        $storage=Storage::disk('fasilitas');
        $fas=Fasilitas::find($id);
        if($req->foto!==null){
            // cek foto
            if($fas->foto!==null){
                $storage->delete($fas->foto);
            }

            $name='';
            $file=$req->foto;
            $fileext=$file->getClientOriginalExtension();
            $filename=$file->getClientOriginalName();
            $new=str_random(20);
            $name=$new.".".$fileext;
            $storage->putFileAs('fasilitas',$file,$name);
            
            $fas->update([
                'nama' => $req->nama,
                'kategorifasilitas_id' => $req->kategori_fasilitas,
                'foto' => $name,
                'slug' => str_slug($req->nama)
            ]);
        }else{
            $fas->update([
                'nama' => $req->nama,
                'kategorifasilitas_id' => $req->kategori_fasilitas,
                'slug' => str_slug($req->nama)
            ]);
        }

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menyimpan Data');
    }

    public function deletefas($id)
    {
        $fas=Fasilitas::find($id);
        if($fas->foto!==null){
            $s=Storage::disk('fasilitas');
            $s->delete($fas->foto);
        }
        $fas->delete();

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Menghapus Data');
    }
}
