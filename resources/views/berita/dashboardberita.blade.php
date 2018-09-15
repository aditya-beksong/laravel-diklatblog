@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Berita</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-sm-2">
        <a href="{{ url('createberita') }}" class="btn btn-success">
            <i class="fa fa-btn fa-plus"></i> Buat Berita Baru
        </a>
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
            <table class="table table-hover table-striped" id="tbdashboardberita">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Kategori Berita</th>
                        <th>Judul Berita</th>
                        <th>Isi Berita</th>
                        <th>Foto</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- // modal add -->

<div class="modal" id="deleteberita" tabindex="-1" role="dialog" aria-labelledby="deleteberitalabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Yakin Mau Hapus Kategori ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="deleteberitafrm">
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

<div class="modal" id="publishberita" tabindex="-1" role="dialog" aria-labelledby="deleteberitalabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatekatlabel">Yakin Mau Publish ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" id="publishberitafrm">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-btn fa-check"></i> Publish</button>
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
    $('#tbdashboardberita').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('getberitadashboard')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'kategori.name', name: 'kategori.name' },
            { data: 'judul', name: 'judul' },
            { data: 'berita', name: 'berita'},
            { data: 'foto', name: 'foto'},
            { data: 'publish', name: 'publish'},
            { data: 'action', name: 'action'},
        ]
    });
});

$('#deleteberita').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('#deleteberitafrm').prop('action','deleteberita/'+link.data('berita_id'));
});

$('#publishberita').on('show.bs.modal',function(e){
    modal=$(this);
    link=$(e.relatedTarget);

    modal.find('#publishberitafrm').prop('action','publishberita/'+link.data('berita_id'));
});
</script>
@endpush