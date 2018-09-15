<a href="{{ url('updateberita/'.$berita->slug) }}" class="btn btn-warning"> <i class="fa fa-btn fa-pencil"></i> </a>&nbsp;
<a data-toggle="modal" data-target="#deleteberita" class="btn btn-danger" data-berita_id="{{$berita->id}}"><i class="fa fa-btn fa-trash"></i></a>
@if(\Auth::user()->hasRole('superadmin','admin'))
&nbsp;<a data-toggle="modal" data-target="#publishberita" class="btn btn-success" data-berita_id="{{$berita->id}}"><i class="fa fa-btn fa-check"></i> Publish</a>
@endif