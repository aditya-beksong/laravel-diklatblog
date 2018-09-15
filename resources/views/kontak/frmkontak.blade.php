@extends('layouts.dashboard')

@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Kontak</h3>
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
    <form action="{{ url('kontak') }}" method="POST" role="form" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-6">
                <input type="text" id="alamat" name="alamat" class="form-control" value="@if($data!==null){{$data->alamat}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="telp" class="col-sm-2 control-label">Telp</label>
            <div class="col-sm-6">
                <input type="text" id="telp" name="telp" class="form-control" value="@if($data!==null){{$data->telp}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="fax" class="col-sm-2 control-label">Fax</label>
            <div class="col-sm-6">
                <input type="text" id="fax" name="fax" class="form-control" value="@if($data!==null){{$data->fax}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="email" class="col-sm-2 control-label">email</label>
            <div class="col-sm-6">
                <input type="text" id="email" name="email" class="form-control" value="@if($data!==null){{$data->email}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="facebook" class="col-sm-2 control-label">facebook</label>
            <div class="col-sm-6">
                <input type="text" id="facebook" name="facebook" class="form-control" value="@if($data!==null){{$data->facebook}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="youtube" class="col-sm-2 control-label">youtube</label>
            <div class="col-sm-6">
                <input type="text" id="youtube" name="youtube" class="form-control" value="@if($data!==null){{$data->youtube}}@endif">
            </div>
        </div>

         <div class="form-group">
            <label for="instagram" class="col-sm-2 control-label">instagram</label>
            <div class="col-sm-6">
                <input type="text" id="instagram" name="instagram" class="form-control" value="@if($data!==null){{$data->instagram}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label for="twitter" class="col-sm-2 control-label">twitter</label>
            <div class="col-sm-6">
                <input type="text" id="twitter" name="twitter" class="form-control" value="@if($data!==null){{$data->twitter}}@endif">
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