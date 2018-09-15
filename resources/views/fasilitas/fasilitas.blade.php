@extends('layouts.dashboard')

@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Fasilitas</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#fasmodaladd">
            <i class="fa fa-btn fa-plus"> Tambah Fasilitas Baru</i>
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
            <table class="table table-hover table-striped" id="tbfasilitas">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
// modal
<div class="modal" id="fasmodaladd" tabindex="-1" role="dialog" aria-labelledby="katmodaladdlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="katmodaladdlabel">Tambah Fasilitas Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="frmfasilitas" class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('fasilitas') }}">
                    @csrf
                    <div class="form-group">
                        <label for="kategori" class="col-sm-3 control-label">Kategori Fasilitas</label>
                        <div class="col-sm-9">
                            <select name="kategori_fasilitas" id="kategori_fasilitas" class="form-control">
                                <option value="">--Pilih Kategori Fasilitas--</option>
                                @foreach($kat as $k)
                                    <option value="{{$k->id}}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama Fasilitas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Fasilitas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto" class="col-sm-3 control-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" id="foto" name="foto" accept="image/*">
                            <p class="help-block" id="filesebelumnya">File Sebelumnya : </p>
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

//updatefasilitas
<div class="modal" id="fasmodalupdate" tabindex="-1" role="dialog" aria-labelledby="katmodaladdlabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="katmodaladdlabel">Tambah Fasilitas Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form id="frmfasilitas" class="form-horizontal" enctype="multipart/form-data" role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kategori" class="col-sm-3 control-label">Kategori Fasilitas</label>
                        <div class="col-sm-9">
                            <select name="kategori_fasilitas" id="kategori_fasilitas" class="form-control">
                                <option value="">--Pilih Kategori Fasilitas--</option>
                                @foreach($kat as $k)
                                    <option value="{{$k->id}}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama Fasilitas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Fasilitas">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto" class="col-sm-3 control-label">Foto</label>
                        <div class="col-sm-9">
                            <input type="file" id="foto" name="foto" accept="image/*">
                            <p class="help-block" id="filesebelumnya">File Sebelumnya : </p>
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

<div class="modal" id="deletefas" tabindex="-1" role="dialog" aria-labelledby="deletekatfaslabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Yakin Mau Hapus Data Fasilitas ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" id="deletefasfrm">
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
    $('#tbfasilitas').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('getfasilitas')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'nama', name: 'nama' },
            { data: 'foto', name: 'foto' },
            { data: 'action', name: 'action' }
        ]
    });
});

$('#fasmodalupdate').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('.modal-body #frmfasilitas').prop('action','updatefasilitas/'+link.data('fas_id'));
    modal.find('.modal-body #kategori_fasilitas').val(link.data('kategori_fasilitas'));
    modal.find('.modal-body #nama').val(link.data('nama'));
    modal.find('.modal-body #filesebelumnya').text('File Sebelumnya : '+link.data('foto'));
});


$('#deletefas').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('.modal-body #deletefasfrm').prop('action','dashboard-fasilitas/'+link.data('fas_id'));
});

</script>
@endpush