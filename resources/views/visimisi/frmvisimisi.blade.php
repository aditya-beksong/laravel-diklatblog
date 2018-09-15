@extends('layouts.dashboard')

@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Visi Misi dan Motto</h3>
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
    <form action="{{ url('visimisi') }}" method="POST" role="form" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <div class="form-group">
            <label for="visi" class="col-sm-2 control-label">Visi</label>
            <div class="col-sm-6">
                <input type="text" id="visi" name="visi" class="form-control" value="@if($data!==null){{$data->visi}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label for="misi" class="col-sm-2 control-label">Misi</label>
            <div class="col-sm-9">
                <textarea name="misi" id="summernote" class="form-control">@if($data!==null){{$data->misi}}@endif</textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="motto" class="col-sm-2 control-label">Motto</label>
            <div class="col-sm-9">
                <input type="text" id="motto" name="motto" class="form-control" value="@if($data!==null){{$data->motto}}@endif">
            </div>
        </div>

        <div class="form-group">
            <label for="sejarah" class="col-sm-2 control-label">Sejarah</label>
            <div class="col-sm-9">
                <textarea name="sejarah" id="summernote1" class="form-control">@if($data!==null){{$data->sejarah}}@endif</textarea>
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

  $('#summernote1').summernote({
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