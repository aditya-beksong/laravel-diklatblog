@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Permission</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#permissionmodaladd">
            <i class="fa fa-btn fa-plus"> Tambah Permission</i>
        </button>
    </div>
    <div class="col-sm-10"></div>
    <div class="col-sm-12">
        <hr>
    </div>
    <div class="col-sm-12">
        @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="permissiontable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- // modal add -->
<div class="modal" id="permissionmodaladd" tabindex="-1" role="dialog" aria-labelledby="permissionmodaladdlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="permissionmodaladdlabel">Add New Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('addpermission') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Permission Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Permission Name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="col-sm-3 control-label">Display Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Permission Display Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-btn fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="updatepermission" tabindex="-1" role="dialog" aria-labelledby="updatepermissionlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatepermissionlabel">Update Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="updatepermissionfrm">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Permission Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Permission Name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="col-sm-3 control-label">Display Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Permission Display Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-btn fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="deletepermission" tabindex="-1" role="dialog" aria-labelledby="deletepermissionlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatepermissionlabel">Yakin Mau Hapus Role ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="deletepermissionfrm">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-danger"> <i class="fa fa-btn fa-trash"></i> Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#permissiontable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('permission/getpermissions')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'name', name: 'name' },
            { data: 'display_name', name: 'display_name' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action'}
        ]
    });
});

$('#updatepermission').on('show.bs.modal',function(e){
	modal=$(this);
	link=$(e.relatedTarget);

	modal.find('#updatepermissionfrm').prop('action','updatepermission/'+link.data('permission_id'));
    modal.find('.modal-body #name').val(link.data('permission_name'));
    modal.find('.modal-body #display_name').val(link.data('display_name'));
    modal.find('.modal-body #description').val(link.data('description'));
});

$('#deletepermission').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('#deletepermissionfrm').prop('action','deletepermission/'+link.data('permission_id'));
});
</script>
@endpush