@extends('layouts.Master')

@section('title', 'Detail Makanan')
@section('master_judul', 'Detail Makanan')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="table-responsive p-3">
            <div class="card-header">
              <h4>Daftar Alergi</h4>
            </div>
            <table id="example" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Alergi</th>
                      <th scope="col">Status</th>
                  </tr>
                </thead>
               <tbody>
                  @foreach ($user as $no => $info)
                  <tr>
                      <td>{{ $no+1 }}</td>
                      <td>{{ $info->name }}</td>
                      <td>{{ $info->alergi }}</td>
                      <td><div class="badge badge-success"> diterima</div></td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
              <h4>Data Seluruh Mahasiswa</h4>
            </div>
            @foreach ($data_mahasiswa as $d)
                <div class="card-body">
                <div class="form-group">
                    <label for="">Jumlah Mahasiswa</label>
                    <label class="form-control">{{ $d->jumlah_mahasiswa }}</label>
                </div>
                <div class="form-group">
                    <label for="">Laki - Laki</label>
                    <label class="form-control">{{ $d->laki_laki }}</label>
                </div>
                <div class="form-group">
                    <label for="">Perempuan</label>
                    <label class="form-control">{{ $d->perempuan }}</label>
                </div>
                </div>
            @endforeach
          </div>
    </div>
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="table-responsive p-3">
            <div class="card-header">
              <h4>Daftar Izin</h4>
            </div>
            <table id="example2" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Alasan</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Status</th>
                  </tr>
                </thead>
               <tbody>
                  @foreach ($user1 as $no => $info)
                  <tr>
                      <td>{{ $no+1 }}</td>
                      <td>{{ $info->name }}</td>
                      <td>{{ $info->alasan }}</td>
                      <td>{{ date('d F Y', strtotime($info->tanggal)) }} / {{ $info->waktu }}</td>
                      <td><div class="badge badge-success"> diterima</div></td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
          </div>
        </div>
</div>
@endsection

@section('modal')

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
