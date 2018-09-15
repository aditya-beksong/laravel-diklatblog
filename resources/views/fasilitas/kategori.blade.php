@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kategori Fasilitas</h3>
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
                        <th>Kategori Fasilitas</th>
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
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ route('addkatfas') }}">
                    @csrf
                    <div class="form-group">
                        <label for="kategori" class="col-sm-3 control-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="name Kategori" required autofocus>
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

<div class="modal" id="updatekatfas" tabindex="-1" role="dialog" aria-labelledby="updatekatlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Update Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="updatekatfasfrm">
                    @csrf
                    <div class="form-group">
                        <label for="kategori" class="col-sm-3 control-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Fasilitas" required autofocus>
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

<div class="modal" id="deletekatfas" tabindex="-1" role="dialog" aria-labelledby="deletekatfaslabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Yakin Mau Hapus Kategori ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="deletekatfasfrm">
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
        ajax: '{{ url('getkategorifasilitas')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'kategori', name: 'kategori' },
            { data: 'action', name: 'action'}
        ]
    });
});

$('#updatekatfas').on('show.bs.modal',function(e){
	modal=$(this);
	link=$(e.relatedTarget);

	modal.find('#updatekatfasfrm').prop('action','updatekatfas/'+link.data('kat_id'));
    modal.find('.modal-body #kategori').val(link.data('kategori'));
});

$('#deletekatfas').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('#deletekatfasfrm').prop('action','deletekatfas/'+link.data('kat_id'));
});
</script>
@endpush