<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;
use Yajra\Datatables\Datatables;

class RupController extends Controller
{
    public function showrolepermissions()
    {
        return view('config.rolepermission');
    }

    public function getrolepermissions()
    {
        $roles=Role::all();
        return Datatables::of($roles)->addColumn('action',function($role){
            return view('config.attachrolepermission',compact('role'))->render();
        })->addIndexColumn()->make('true');
    }

    public function attachprfrm($role_id)
    {
        $role=Role::find($role_id);
        $perms=Permission::all();
        return view('config.frmattachrp',compact('role','perms'));
    }

    public function attachpermissiontorole(Request $req,$id)
    {
        $role=Role::find($id);
        if($req->perm==null){
            \Session::flash('alert-class','alert-success');
            return redirect('rolepermission')->with('message','Minimal pilih satu permission');
        }
        $role->syncPermissions($req->perm);
        // foreach ($req->perm as $key => $value) {
        //     $role->attachPermission($value);
        // }
        \Session::flash('alert-class','alert-success');
        return redirect('rolepermission')->with('message','Berhasil Ubah Data');
    }

    public function detachpermissiontorole($id)
    {
        $role=Role::find($id);
        $perms=Permission::all();
        foreach ($perms as $key => $p) {
            if($role->hasPermission($p->name)){
                $role->detachPermission($p->name);
            }

        }
        \Session::flash('alert-class','alert-success');
        return redirect('rolepermission')->with('message','Berhasil Ubah Data');
    }

    // role user
    public function showroleuser()
    {
        return view('config.roleuser');
    }

    public function getroleusers()
    {
        $roles=User::all();
        return Datatables::of($roles)->addColumn('action',function($role){
            return view('config.attachroleuser',compact('role'))->render();
        })->addIndexColumn()->make('true');
    }

    public function attachrufrm($user_id)
    {
        $user=User::find($user_id);
        $roles=Role::all();
        return view('config.frmattachru',compact('roles','user'));
    }

    public function attachroleuser(Request $req,$id)
    {
        $user=User::find($id);
        if($req->perm==null){
            \Session::flash('alert-class','alert-success');
            return redirect('roleuser')->with('message','Minimal pilih satu permission');
        }
        $user->syncRoles($req->perm);
        // foreach ($req->perm as $key => $value) {
        //     $role->attachPermission($value);
        // }
        \Session::flash('alert-class','alert-success');
        return redirect('roleuser')->with('message','Berhasil Ubah Data');
    }

    public function detachroleuser($id)
    {
        $user=User::find($id);
        $roles=Role::all();
        foreach ($roles as $key => $p) {
            if($user->hasRole($p->name)){
                $user->detachRole($p->name);
            }

        }
        \Session::flash('alert-class','alert-success');
        return redirect('roleuser')->with('message','Berhasil Ubah Data');
    }
}
