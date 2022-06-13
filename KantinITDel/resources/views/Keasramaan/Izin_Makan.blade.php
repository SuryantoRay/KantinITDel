@extends('layouts.Master')

@section('title', 'Izin Tidak Makan')
@section('master_judul', 'Izin Tidak Makan')

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
                                  <th scope="col">Nama</th>
                                  <th scope="col">Prodi</th>
                                  <th scope="col">Tanggal</th>
                                  <th scope="col">Waktu</th>
                                  <th scope="col">Alasan</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach ($izin as $no => $us)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $us->name }}</td>
                                    <td>{{ $us->kedudukan }}</td>
                                    <td>{{ date('d F Y', strtotime($us->tanggal)) }}</td>
                                    <td>{{ $us->waktu }}</td>
                                    <td>{{ $us->alasan }}</td>
                                    <td>
                                        @if ($us->status == "diterima")
                                            <div class="badge badge-success"> diterima</div>
                                        @elseif ($us->status == "ditolak")
                                            <div class="badge badge-danger">ditolak</div>
                                        @elseif ($us->status == "menunggu")
                                            <div class="badge badge-warning">menunggu</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($us->status == "diterima")
                                            <a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#status{{ $us->id }}"> Tolak</a>
                                        @elseif ($us->status == "ditolak")
                                            <a href="" class="btn btn-icon icon-left btn-success" data-toggle="modal" data-target="#status{{ $us->id }}"> Terima</a>
                                        @elseif ($us->status == "menunggu")
                                            <a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#status2{{ $us->id }}"> Tolak</a>
                                            <a href="" class="btn btn-icon icon-left btn-success" data-toggle="modal" data-target="#status3{{ $us->id }}"> Terima</a>
                                        @endif
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
{{-- Bagian Edit Status --}}
@foreach ($izin as $us)
<div class="modal fade" id="status{{ $us->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ub.st_iz') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $us->id }}"/>
                <div class="form-group">
                    <p>Apakah Anda Yakin Ingin <b>Mengubah Statusnya</b> !</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                    <input type="submit" class="btn btn-primary" value="Ubah">
                </div>
            </form>
        </div>
    </div>
  </div>
  @endforeach

  @foreach ($izin as $us)
<div class="modal fade" id="status2{{ $us->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ub.st_iz2') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $us->id }}"/>
                <input type="hidden" name="status" value="ditolak"/>
                <div class="form-group">
                    <p>Apakah Anda Yakin Ingin <b>Mengubah Statusnya</b> !</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                    <input type="submit" class="btn btn-primary" value="Ubah">
                </div>
            </form>
        </div>
    </div>
  </div>
  @endforeach

  @foreach ($izin as $us)
<div class="modal fade" id="status3{{ $us->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ub.st_iz2') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $us->id }}"/>
                <input type="hidden" name="status" value="diterima"/>
                <div class="form-group">
                    <p>Apakah Anda Yakin Ingin <b>Mengubah Statusnya</b> !</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                    <input type="submit" class="btn btn-primary" value="Ubah">
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
