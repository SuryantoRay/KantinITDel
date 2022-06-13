@extends('layouts.Master')

@section('title', 'Tambah Kategori')
@section('master_judul', 'Tambah Kategori')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <div class="card-body">
              <ul class="nav nav-pills" id="myTab3" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="false">Kategori Saya</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="true">Semua Kategori</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent2">
                <div class="tab-pane fade active show" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                    <div class="table-responsive p-3">
                        <table id="example2" class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Action</th>
                                </tr>
                              </thead>
                             <tbody>
                                @foreach ($User as $as)
                                @foreach ($as->kategori as $no => $k)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $k->kode }}</td>
                                    <td>{{ $k->kategori }}</td>
                                    <td>
                                      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#edit_kategori{{ $k->id }}"><i class="fas fa-edit"></i> Edit</a> |
                                      <a href="" class="btn btn-icon icon-left btn-danger" data-toggle="modal" data-target="#hapus{{ $k->id }}"><i class="fas fa-trash-alt"></i> Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
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
                                    <th scope="col">Kode</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Pencetak Kategori</th>
                                </tr>
                              </thead>
                             <tbody>
                                @foreach ($Kategori as $skr)
                                @foreach ($skr->kategori as $sk)
                                <tr>
                                    <td>{{ $sk->kode }}</td>
                                    <td>{{ $sk->kategori }}</td>
                                    <td>{{ $skr->name }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                             </tbody>
                          </table>
                      </div>
                </div>
              </div>
            </div>
          </div>
    </div>

      <div class="col-12 col-md-12 col-lg-5">
        @if($errors->has('kategori_ed'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>i
                        Gagal Edit Kategori. {{ $errors->first('kategori_ed') }}
                    </div>
                </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h4>Tambah Kategori</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('proses_tmK') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
                <div class="form-group">
                    <label @error('kode') class="text-danger" role="alert" @enderror> Kode @error('kode') | {{ $message }} @enderror</label>
                    <input type="text" name="kode" value="{{ old('kode') }}" class="form-control">
                  </div>
                  <div class="form-group">
                      <label @error('kategori') class="text-danger"  role="alert" @enderror> Kategori @error('kategori') | {{ $message }} @enderror</label>
                      <input type="text" name="kategori" value="{{ old('kategori') }}" class="form-control">
                    </div>
                <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                <input type="reset" class="btn btn-secondary" value="Reset">
              </div>
            </form>
          </div>
        </div>

        {{-- <div class="card">
            <div class="card-header">
                <h4>Info Error Edit</h4>
              </div>
            <div class="card-body">
                <b><p @error('kategori_ed') class="text-danger" role="alert" @enderror> @error('kategori_ed')  {{ $message }} @enderror</p></b>
            </div>
        </div>
      </div> --}}
</div>
@endsection

@section('modal')
    {{-- Modal edit Kategori --}}
    @foreach ($User as $as)
    @foreach ($as->kategori as $k  )
    <div class="modal fade" id="edit_kategori{{ $k->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ed.kategori') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $k->id }}"/>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori_ed" value="{{ $k->kategori }}" class="form-control">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
      </div>
      @endforeach
      @endforeach

      {{-- Bagian Hapus Komponen --}}
      @foreach ($User as $as)
      @foreach ($as->kategori as $k  )
      <div class="modal fade" id="hapus{{ $k->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('h.kategori') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{ $k->id }}"/>
                      <div class="form-group">
                          <p>Apakah Anda Yakin Ingin Menghapus Kategori <b>{{ $k->kategori }}</b> !</p>
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
            $('#example2').DataTable();
        });
    </script>
@endpush
