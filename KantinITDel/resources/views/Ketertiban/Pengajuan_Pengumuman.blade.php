@extends('layouts.Master')

@section('title', 'Pengajuan Pengumuman')
@section('master_judul', 'Daftar Pengumuman')

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
                                  <th scope="col">Tanggal Pengajuan</th>
                                  <th scope="col">Lihat</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach ($pengumuman as $no => $us)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $us->name }}</td>
                                    <td>{{ $us->kedudukan }}</td>
                                    <td>
                                        <?php
                                            $tgl = date_create($us->created_at);
                                            $formatted_date = date_format($tgl, "d F Y");
                                            echo $formatted_date;
                                        ?>
                                    </td>
                                    <td>{{ $us->judul }}</td>
                                    <td>
                                        @if ($us->status == "aktif")
                                            <div class="badge badge-success"> Aktif</div>
                                        @elseif ($us->status == "non aktif")
                                            <div class="badge badge-danger"> Non Aktif</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($us->status == "aktif")
                                            <a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#status{{ $us->id }}"> Non Aktifkan</a>
                                        @elseif ($us->status == "non aktif")
                                            <a href="" class="btn btn-icon icon-left btn-success" data-toggle="modal" data-target="#status{{ $us->id }}"> Aktifkan</a>
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
{{-- {{-- Bagian Edit Status --}}
@foreach ($pengumuman as $us)
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
            <form action="{{ route('ub.pe_ktr') }}" method="post" enctype="multipart/form-data">
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
