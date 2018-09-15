@extends('layouts.dashboard')
@section('dashboardcontent')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Attach Role To Permission</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
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
            <table class="table table-hover table-striped" id="tbrolepermission">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Role Name</th>
                        <th>Attach</th>
                        <!-- <th>Detach</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#tbrolepermission').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('getrolepermissions')}}',
        columns: [
            { data: 'DT_Row_Index', name: 'DT_Row_Index' },
            { data: 'display_name', name: 'display_name' },
            { data: 'action', name: 'attach' },
            // { data: 'action', name: 'action'}
        ]
    });
});
</script>
@endpush