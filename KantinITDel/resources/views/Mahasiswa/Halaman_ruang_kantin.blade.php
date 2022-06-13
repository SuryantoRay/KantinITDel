@extends('layouts.Master')

@section('title', 'Request Kantin')
@section('master_judul', 'Penggunaan Ruangan Kantin')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-6">
        <div class="section-header">
            <a href="" data-toggle="modal" class="btn btn-success" data-target="#tambah">+ Buat Request</a>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Semua Request</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                      <th scope="col">No</th>
                                      <th scope="col">Ruangan</th>
                                      <th scope="col">Waktu</th>
                                      <th scope="col">Pengguna</th>
                                      <th scope="col">Aksi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  @foreach ($User as $no => $us)
                                  <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $us->ruangan }}</td>
                                    <td>{{ date('d F Y', strtotime($us->tanggal_Penggunaan)) }}</td>
                                    <td>{{ $us->name }}</td>
                                    <td>
                                        @if ($us->aksi == "diterima")
                                            <div class="badge badge-success"> diterima</div>
                                        @elseif ($us->aksi == "ditolak")
                                            <div class="badge badge-danger">ditolak</div>
                                        @elseif ($us->aksi == "menunggu")
                                            <div class="badge badge-warning">menunggu</div>
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

    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Request Saya</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-3">
                    <form action="" method="post">
                        <table id="example2" class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Ruangan</th>
                                  <th scope="col">Waktu</th>
                                  <th scope="col">opsi</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($Ruangan_kantin as $no => $rkk)
                              <tr>
                                  <td>{{ $no+1 }}</td>
                                  <td>{{ $rkk->ruangan }}</td>
                                  <td>{{ date('d F Y', strtotime($rkk->tanggal_Penggunaan)) }}</td>
                                  <td>
                                    @if ($rkk->aksi == "diterima")
                                        <div class="badge badge-success"> diterima</div>
                                    @elseif ($rkk->aksi == "ditolak")
                                        <div class="badge badge-danger">ditolak</div>
                                    @elseif ($rkk->aksi == "menunggu")
                                        <div class="badge badge-warning">menunggu</div>
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
{{-- Bagian Tambah Permintaan --}}
<div class="modal fade" id="tambah" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Buat Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('tm_request') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label @error('ruangan') class="text-danger" role="alert" @enderror> Ruangan @error('ruangan') | {{ $message }} @enderror</label>
                    <select name="ruangan" class="form-control">
                        <option value="Kantin Baru 1 Lantai 1">Kantin Baru 1 Lantai 1</option>
                        <option value="Kantin Baru 1 Lantai 2">Kantin Baru 1 Lantai 2</option>
                        <option value="Kantin Baru tengah Lantai 1">Kantin tengah Baru Lantai 1</option>
                        <option value="Kantin Baru tengah Lantai 2">Kantin tengah Baru Lantai 2</option>
                        <option value="Kantin Baru 2 Lantai 1">Kantin Baru 2 Lantai 1</option>
                        <option value="Kantin Baru 2 Lantai 2">Kantin Baru 2 Lantai 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label @error('tanggal_Penggunaan') class="text-danger" role="alert" @enderror> Tanggal Penggunaan @error('tanggal_Penggunaan') | {{ $message }} @enderror</label>
                    <input class="form-control" type="date" name="tanggal_Penggunaan">
                </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection

@push('top-script')

@endpush

@push('page-script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example2').DataTable();
        });
    </script>
@endpush
