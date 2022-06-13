@extends('layouts.Master')

@section('title', 'Buat Surat Izin')
@section('master_judul', 'Buat Surat Izin Tidak Makan')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Buat Request Tidak Makan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tm_izin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label @error('tanggal') class="text-danger" role="alert" @enderror> Tanggal @error('tanggal') | {{ $message }} @enderror</label>
                        <input class="form-control" value="{{ old('tanggal') }}" type="date" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label @error('waktu') class="text-danger" role="alert" @enderror> Waktu @error('waktu') | {{ $message }} @enderror</label>
                        <select name="waktu" class="form-control">
                            <option value="Pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="Malam">Malam</option>
                            <option value="1 Harian">1 Harian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label @error('alasan') class="text-danger" role="alert" @enderror> Alasan @error('alasan') | {{ $message }} @enderror</label>
                        <textarea class="form-control" name="alasan">{{ old('alasan') }}</textarea>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4>Request Anda</h4>
            </div>
            <div class="card-body">
                <table id="example" class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                          <th scope="col">No</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Waktu</th>
                          <th scope="col">Keterangan</th>
                          <th scope="col">Batalkan</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($Izin as $no => $iz)
                      <tr>
                          <td>{{ $no+1 }}</td>
                          <td>{{ date('d F Y', strtotime($iz->tanggal)) }}</td>
                          <td>{{ $iz->waktu }}</td>
                          <td>
                            @if ($iz->status == "diterima")
                                <div class="badge badge-success"> diterima</div>
                            @elseif ($iz->status == "ditolak")
                                <div class="badge badge-danger">ditolak</div>
                            @elseif ($iz->status == "menunggu")
                                <div class="badge badge-warning">menunggu</div>
                            @endif
                          </td>
                          <td>
                            @if ($iz->status == "menunggu")
                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $iz->id }}"> Batalkan</a>
                            @else
                                <a href="" class="btn btn-info" data-toggle="modal" data-target="#lihat{{ $iz->id }}"> Detail</a>
                            @endif
                          </td>
                      </tr>
                      @endforeach
                   </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
{{-- Bagian Hapus pengumuman --}}
@foreach ($Izin as $iz)
<div class="modal fade" id="hapus{{ $iz->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Batalkan Izin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('bt_izin') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $iz->id }}"/>
                <div class="form-group">
                    <p>Apakah Anda Yakin Ingin Membatalkan</b> !</p>
                </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-danger" value="Yakin">
                </div>
            </form>
        </div>
    </div>
  </div>
  @endforeach

@foreach ($Izin as $iz)
<div class="modal fade" id="lihat{{ $iz->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Detail | @if ($iz->status == "diterima")
            <div class="badge badge-success"> diterima</div>
            @elseif ($iz->status == "ditolak")
                <div class="badge badge-danger">ditolak</div>
            @elseif ($iz->status == "menunggu")
                <div class="badge badge-warning">menunggu</div>
            @endif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $iz->id }}"/>
                <div class="form-group">
                    <p>Berikut Detail Izin Anda</p>
                </div>
                <div class="form-group">
                    <label for="">Tanggal : {{ $iz->tanggal }}</label><br>
                    <label for="">Waktu   : {{ $iz->waktu }}</label><br>
                    <label for="">Alasan  : {{ $iz->alasan  }}</label>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
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
