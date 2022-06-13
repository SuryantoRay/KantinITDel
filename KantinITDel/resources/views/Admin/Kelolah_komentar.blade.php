@extends('layouts.Master')

@section('title', 'Kelolah Komentar')
@section('master_judul', 'Kelolah Komentar')

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
                                  <th scope="col">Nama</th>
                                  <th scope="col">Tanggal</th>
                                  <th scope="col">Isi</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Opsi</th>
                                  <th scope="col"></th>
                              </tr>
                           </thead>
                           <tbody>
                                @foreach ($komen as $k)
                                    <tr>
                                        <td>{{ $k->nama }}</td>
                                    <td>{{ $k->created_at->format('d M Y') }}</td>
                                    <td>{{ $k->komen }}</td>
                                    <td>
                                        @if ($k->status == "aktif")
                                            <div class="badge badge-success">Active</div>
                                        @elseif ($k->status == "non aktif")
                                            <div class="badge badge-danger">Non Active</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($k->status == "aktif")
                                            <a href="" class="btn btn-icon icon-left btn-warning" data-toggle="modal" data-target="#status{{ $k->id }}"> NonActive</a>
                                        @elseif ($k->status == "non aktif")
                                            <a href="" class="btn btn-icon icon-left btn-success" data-toggle="modal" data-target="#status{{ $k->id }}"> Active</a>
                                        @endif
                                    </td>
                                    <td><a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#hapus{{ $k->id }}"> Hapus</a></td>
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
    {{-- Bagian Hapus komen --}}
    @foreach ($komen as $k )
    <div class="modal fade" id="hapus{{ $k->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Hapus Komentar</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hapus.kom') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $k->id }}"/>
                    <div class="form-group">
                        <p>Apakah Anda Yakin Ingin Menghapus komentar !</p>
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

    {{-- Bagian Edit Status --}}
    @foreach ($komen as $k )
    <div class="modal fade" id="status{{ $k->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Ubah Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('edit.status_kom') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $k->id }}"/>
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
