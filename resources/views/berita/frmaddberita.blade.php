@extends('layouts.dashboard')

@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Buat Berita Baru</h3>
    </div>
    <!-- /.col-lg-12 -->
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
    <form action="{{ url('createberita') }}" method="POST" role="form" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="form-group">
            <label for="kategori" class="col-sm-2 control-label">Kategori Berita</label>
            <div class="col-sm-6">
                <select name="kategori" id="kategori" required class="form-control">
                    <option value="">-- Pilih Kategori Berita--</option>
                    @foreach($kats as $k)
                        <option value="{{$k->id}}">{{ $k->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="judul" class="col-sm-2 control-label">Judul Berita</label>
            <div class="col-sm-9">
                <input type="text" id="judul" name="judul" required class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="berita" class="col-sm-2 control-label">Isi Berita</label>
            <div class="col-sm-9">
                <textarea name="berita" id="summernote" class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="foto" class="col-sm-2 control-label">Foto Berita</label>
            <div class="col-sm-9">
                <input type="file" id="foto" name="foto" accept="image/*" >
            </div>
        </div>

        <div class="from-group">
            <div class="col-sm-offset-2">
                <button type="submit" class="btn btn-success"> <i class="fa fa-btn fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts') 
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote({
    height: 200,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
  });
});
</script>
@endpush