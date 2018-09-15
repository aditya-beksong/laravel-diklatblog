<?php

namespace App\Http\Controllers;

use App\Berita;
use App\Kategori;
use Yajra\Datatables\Datatables;
use Storage;
use App\Http\Requests\BeritaRequest as Request;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('berita.dashboardberita');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kats=Kategori::all();
        return view('berita.frmaddberita',compact('kats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storage=Storage::disk('berita');
        $name='';
        if($request->foto!==null){
            $file=$request->foto;
            $fileext=$file->getClientOriginalExtension();
            $filename=$file->getClientOriginalName();
            $new=str_random(20);
            $name=$new.".".$fileext;
            $storage->putFileAs('berita',$file,$name);
        }

        $berita=new Berita(array(
            'user_id' => \Auth::user()->id,
            'judul' => $request->judul,
            'berita' => $request->berita,
            'slug' => str_slug($request->judul,'-'),
            'kategori_id' => $request->kategori,
            'foto' => $name,
        ));

        $berita->save();

        \Session::flash('alert-class','alert-success');
        return redirect('dashberita')->with('message','Berhasil Menyimpan Berita');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {   
        $kats=Kategori::all();
        $data=Berita::where('slug',$slug)->firstOrFail();
        return view('berita.frmupdateberita',compact('kats','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$slug)
    {
        $storage=Storage::disk('berita');
        $berita=Berita::where('slug',$slug)->firstOrFail();
        if($request->foto!==null){
            $name='';
            $file=$request->foto;
            $fileext=$file->getClientOriginalExtension();
            $filename=$file->getClientOriginalName();
            $new=str_random(20);
            $name=$new.".".$fileext;
            $storage->putFileAs('berita',$file,$name);
            if($berita->foto!=null){
                $storage->delete($berita->foto);
            }

            $berita->update([
                'user_id' => \Auth::user()->id,
                'judul' => $request->judul,
                'berita' => $request->berita,
                'slug' => str_slug($request->judul,'-'),
                'kategori_id' => $request->kategori,
                'foto' => $name,
            ]);
        }else{
            $berita->update([
                'user_id' => \Auth::user()->id,
                'judul' => $request->judul,
                'berita' => $request->berita,
                'slug' => str_slug($request->judul,'-'),
                'kategori_id' => $request->kategori,
            ]);
        }
        \Session::flash('alert-class','alert-success');
        return redirect('dashberita')->with('message','Berhasil Ubah Berita');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $berita=Berita::find($id);
        $berita->update(['publish'=> true]);
        \Session::flash('alert-class','alert-success');
        return redirect('dashberita')->with('message','Berhasil publish Berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita=Berita::find($id);
        $storage=Storage::disk('berita');
        $storage->delete('berita/'.$berita->foto);

        $berita->delete();

        \Session::flash('alert-class','alert-success');
        return redirect('dashberita')->with('message','Berhasil Hapus Berita');
    }

    public function getBerita()
    {
        if(\Auth::user()->hasRole('superadmin')){
            $beritas=Berita::with('kategori')->get();
        }else{
            $beritas=Berita::with(['user','kategori'])->where('user_id',\Auth::user()->id)->get();
        }

        return Datatables::of($beritas)
        ->addColumn('action',function($berita){
            return view('berita.actiondashberita',compact('berita'))->render();
        })->addIndexColumn()->make('true');
    }
}
