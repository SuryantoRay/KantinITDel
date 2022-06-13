@extends('layouts.Master')

@section('title', 'Semua Pengumuman')
@section('master_judul', 'Semua Pengumuman')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive p-3">
                    <form action="" method="post">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Judul</th>
                                  <th scope="col">Kapada</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Opsi</th>
                                  <th scope="col"></th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($pengumuman as $no => $info)
                              <tr>
                                  <td>{{ $no+1 }}</td>
                                  <td><a href="{{ route('bc.pe_ktr',$info->id) }}">{{ $info->judul }}</a></td>
                                  <td>{{ $info->kepada }}</td>
                                  <td>
                                      @if ($info->status == "aktif")
                                        <div class="badge badge-success"> Active</div>
                                      @elseif ($info->status == "non aktif")
                                        <div class="badge badge-danger">Non Active</div>
                                      @endif
                                  </td>
                                  <td><a href="{{ route('ed.pe_ktr',$info->id) }}" class="btn btn-icon icon-left btn-primary"> Edit</a></td>
                                  <td><a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#hapus{{ $info->id }}"> Hapus</a>
                                  </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    {{-- Bagian Hapus pengumuman --}}
    @foreach ($pengumuman as $info )
    <div class="modal fade" id="hapus{{ $info->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Hapus Pengumuman</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hp.pe_ktr') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $info->id }}"/>
                    <div class="form-group">
                        <p>Apakah Anda Yakin Ingin Menghapus <b>{{ $info->judul }}</b> !</p>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Batalkan</button>
                        <input type="submit" class="btn btn-danger" value="Hapus">
                    </div>
                </form>
            </div>
        </div>
      </div>
      @endforeach
@endsection

@push('top-script')

@endpush

@push('page-script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
