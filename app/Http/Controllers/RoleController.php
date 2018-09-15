<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Role;
use App\Http\Requests\RoleRequest as Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('config.role');
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
    public function store(Request $req)
    {
        $role=new Role(array(
            'name' => strtolower($req->name),
            'display_name' => $req->display_name,
            'description' => $req->description
        ));

        $role->save();

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Simpan Data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $role=Role::find($id);
        $role->update([
            'name' => strtolower($req->name),
            'display_name' => $req->display_name,
            'description' => $req->description
        ]);

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Ubah Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role=Role::find($id);
        $role->delete();

        \Session::flash('alert-class','alert-success');
        return redirect()->back()->with('message','Berhasil Hapus Data');
    }

    public function getroles()
    {
        $roles=Role::all();
        return Datatables::of($roles)
        ->addColumn('action',function($role){
            return '<a href="" class="btn btn-warning" data-toggle="modal" data-target="#updaterole" data-role_id="'.$role->id.'" data-role_name="'.$role->name.'" data-display_name="'.$role->display_name.'" data-description="'.$role->description.'"><i class="fa fa-btn fa-pencil"></i></a>&nbsp;<a class="btn btn-danger" data-toggle="modal" data-target="#deleterole" data-role_id="'.$role->id.'"><i class="fa fa-btn fa-trash"></i></a>';
        })
        ->addIndexColumn()->make('true');
    }
}
