@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kategori Berita</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#katmodaladd">
            <i class="fa fa-btn fa-plus"> Buat Kategori Baru</i>
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
            <table class="table table-hover table-striped" id="tbkategori">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori Berita</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- // modal add -->
<div class="modal" id="katmodaladd" tabindex="-1" role="dialog" aria-labelledby="katmodaladdlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="katmodaladdlabel">Tambah Kategori Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('addkat') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="name Kategori" required autofocus>
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

<div class="modal" id="updatekat" tabindex="-1" role="dialog" aria-labelledby="updatekatlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Update Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="updatekatfrm">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Role Name" required autofocus>
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

<div class="modal" id="deletekat" tabindex="-1" role="dialog" aria-labelledby="deletekatlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Yakin Mau Hapus Kategori ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="deletekatfrm">
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
    $('#tbkategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('getkategori')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'name', name: 'name' },
            { data: 'action', name: 'action'}
        ]
    });
});

$('#updatekat').on('show.bs.modal',function(e){
	modal=$(this);
	link=$(e.relatedTarget);

	modal.find('#updatekatfrm').prop('action','updatekat/'+link.data('kat_id'));
    modal.find('.modal-body #name').val(link.data('kat_name'));
});

$('#deletekat').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('#deletekatfrm').prop('action','deletekat/'+link.data('kat_id'));
});
</script>
@endpush