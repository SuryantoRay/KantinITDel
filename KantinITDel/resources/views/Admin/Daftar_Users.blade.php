@extends('layouts.Master')

@section('title', 'Daftar Users')
@section('master_judul', 'Users')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills" id="myTab3" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="false">Mahasiswa</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true">Ketertiban</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="true">Keasramaan</a>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                    <div class="table-responsive p-3">
                        <table id="example1" class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Detail</th>
                                </tr>
                              </thead>
                             <tbody>
                                @foreach ($mahasiswa as $no => $ma)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>
                                        @if ($ma->gambar == 0)
                                        <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                                        @else
                                            <img src="{{ asset('img/Mahasiswa/Profil/'.$ma->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                                        @endif
                                    </td>
                                    <td>{{ $ma->name }}</td>
                                    <td>{{ date('d F Y', strtotime($ma->tanggal_Lahir )) }}</td>
                                    <td>
                                        @if($ma->jenis_Kelamin == "L")
                                            Laki - Laki
                                        @elseif ($ma->jenis_Kelamin == "P")
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>{{ $ma->kedudukan }}</td>
                                    <td> <a href="" class="btn btn-info" data-toggle="modal" data-target="#lihat{{ $ma->id }}"> Detail</a> </td>
                                </tr>
                                @endforeach
                             </tbody>
                          </table>
                      </div>
                </div>
                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                    <div class="table-responsive p-3">
                        <table id="example" class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Prodi</th>
                                    <th scope="col">Detail</th>
                                </tr>
                              </thead>
                             <tbody>
                                @foreach ($ketertiban as $no => $ma)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>
                                        @if ($ma->gambar == 0)
                                        <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                                        @else
                                            <img src="{{ asset('img/Ketertiban/Profil/'.$ma->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                                        @endif
                                    </td>
                                    <td>{{ $ma->name }}</td>
                                    <td>{{ date('d F Y', strtotime($ma->tanggal_Lahir )) }}</td>
                                    <td>
                                        @if($ma->jenis_Kelamin == "L")
                                            Laki - Laki
                                        @elseif ($ma->jenis_Kelamin == "P")
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>{{ $ma->kedudukan }}</td>
                                    <td> <a href="" class="btn btn-info" data-toggle="modal" data-target="#lihat{{ $ma->id }}"> Detail</a> </td>
                                </tr>
                                @endforeach
                             </tbody>
                          </table>
                      </div>
                </div>
                <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab3">
                    <div class="table-responsive p-3">
                        <table id="example2" class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Asrama</th>
                                    <th scope="col">Detail</th>
                                </tr>
                              </thead>
                             <tbody>
                                @foreach ($keasramaan as $no => $ma)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>
                                        @if ($ma->gambar == 0)
                                        <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                                        @else
                                            <img src="{{ asset('img/Keasramaan/Profil/'.$ma->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                                        @endif
                                    </td>
                                    <td>{{ $ma->name }}</td>
                                    <td>{{ date('d F Y', strtotime($ma->tanggal_Lahir )) }}</td>
                                    <td>
                                        @if($ma->jenis_Kelamin == "L")
                                            Laki - Laki
                                        @elseif ($ma->jenis_Kelamin == "P")
                                            Perempuan
                                        @endif
                                    </td>
                                    <td>{{ $ma->kedudukan }}</td>
                                    <td> <a href="" class="btn btn-info" data-toggle="modal" data-target="#lihat{{ $ma->id }}"> Detail</a> </td>
                                </tr>
                                @endforeach
                             </tbody>
                          </table>
                      </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@section('modal')
{{-- mahasiswa --}}
@foreach ($mahasiswa as $m)
<div class="modal fade" id="lihat{{ $m->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Detail | <b>{{ $m->name }}</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $m->id }}"/>
                <div class="form-group">
                    <p>Berikut Detail User</p>
                </div>
                <div class="form-group">
                    <li class="media">
                        @if ($m->gambar == 0)
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                        @else
                            <img src="{{ asset('img/Mahasiswa/Profil/'.$m->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                        @endif
                        <div class="media-body pl-5">
                          <label>Nama            : {{ $m->name }}</label><br>
                          <label>Tanggal Lahir   : {{ date('d F Y', strtotime($m->tanggal_Lahir )) }}</label><br>
                          <label>Jenis Kelamin   :
                            @if($m->jenis_Kelamin == "L")
                                Laki - Laki
                            @elseif ($m->jenis_Kelamin == "P")
                                Perempuan
                            @endif
                          </label><br>
                          <label>Prodi           : {{ $m->kedudukan }}</label><br>
                          <label>Alamat           : {{ $m->alamat }}</label><br>
                        </div>
                    </li>
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

  {{-- ketertiban --}}
@foreach ($ketertiban as $m)
<div class="modal fade" id="lihat{{ $m->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Detail | <b>{{ $m->name }}</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $m->id }}"/>
                <div class="form-group">
                    <p>Berikut Detail User</p>
                </div>
                <div class="form-group">
                    <li class="media">
                        @if ($m->gambar == 0)
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                        @else
                            <img src="{{ asset('img/Ketertiban/Profil/'.$m->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                        @endif
                        <div class="media-body pl-5">
                          <label>Nama            : {{ $m->name }}</label><br>
                          <label>Tanggal Lahir   : {{ date('d F Y', strtotime($m->tanggal_Lahir )) }}</label><br>
                          <label>Jenis Kelamin   :
                            @if($m->jenis_Kelamin == "L")
                                Laki - Laki
                            @elseif ($m->jenis_Kelamin == "P")
                                Perempuan
                            @endif
                          </label><br>
                          <label>Prodi           : {{ $m->kedudukan }}</label><br>
                          <label>Alamat           : {{ $m->alamat }}</label><br>
                        </div>
                    </li>
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

  {{-- keasramaan --}}
@foreach ($keasramaan as $m)
<div class="modal fade" id="lihat{{ $m->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Detail | <b>{{ $m->name }}</b>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $m->id }}"/>
                <div class="form-group">
                    <p>Berikut Detail User</p>
                </div>
                <div class="form-group">
                    <li class="media">
                        @if ($m->gambar == 0)
                            <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" width="100" height="100" class="rounded-circle mr-1">
                        @else
                            <img src="{{ asset('img/Keasramaan/Profil/'.$m->gambar) }}" width="100" height="100" class="rounded-circle mr-1">
                        @endif
                        <div class="media-body pl-5">
                          <label>Nama            : {{ $m->name }}</label><br>
                          <label>Tanggal Lahir   : {{ date('d F Y', strtotime($m->tanggal_Lahir )) }}</label><br>
                          <label>Jenis Kelamin   :
                            @if($m->jenis_Kelamin == "L")
                                Laki - Laki
                            @elseif ($m->jenis_Kelamin == "P")
                                Perempuan
                            @endif
                          </label><br>
                          <label>Asrama           : {{ $m->kedudukan }}</label><br>
                          <label>Alamat           : {{ $m->alamat }}</label><br>
                        </div>
                    </li>
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
    <script>
        $(document).ready(function() {
            $('#example1').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example2').DataTable();
        });
    </script>
@endpush
