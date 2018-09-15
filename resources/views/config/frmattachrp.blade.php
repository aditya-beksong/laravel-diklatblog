@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Attach Role To Permission</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
   <form action="" class="form-horizontal" enctype="multipart/form-data" action="{{url('attachpr/'.$role->id)}}" method="POST">
   @csrf
        <div class="form-group">
            <label for="role_name" class="col-sm-2 control-label">Role Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="role_name" value="{{$role->display_name}}" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <label for="permission_name" class="col-sm-6 control-label">Check Permission Below</label>
        </div>
        <div class="form-group">
            @foreach($perms as $p)
                <div class="col-sm-2">
                    <div class="checkbox">
                        @if($role->hasPermission($p->name))
                            <input type="checkbox" name="perm[]" id="perm" value="{{$p->id}}" checked>{{$p->display_name}}
                        @else
                            <input type="checkbox" name="perm[]" id="perm" value="{{$p->id}}">{{$p->display_name}}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success"> <i class="fa fa-btn fa-save"></i> Simpan</button>
            </div>
        </div>
   </form> 
</div>
@endsection
