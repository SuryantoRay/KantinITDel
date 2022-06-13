@extends('layouts.Master')

@section('title', 'Tambah Infromasi')
@section('master_judul', 'Tambah Informasi')

@push('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                  <h4>Tambah Informasi</h4>
                </div>
                <form action="{{ route('tm.informasi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"/>
                    <div class="card-body">
                        <div class="form-group">
                            <label @error('judul') class="text-danger" role="alert" @enderror> Judul @error('judul') | {{ $message }} @enderror</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" />
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select  name="kategori" class="form-control">
                                @foreach ($Kategori as $k)
                                    <option value="{{ $k->kategori }}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label @error('isi') class="text-danger" role="alert" @enderror> Isi @error('isi') | {{ $message }} @enderror</label>
                            <textarea name="isi" id="summernote">{{ old('isi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label @error('gambar_if') class="text-danger" role="alert" @enderror> Gambar @error('gambar_if') | {{ $message }} @enderror</label>
                            <input class="form-control" type="file" name="gambar_if">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                  <h4>Informasi Yang Anda Buat</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled">
                    @foreach ($Informasi as $usa)
                    <li class="media">
                        <img class="mr-3" src="{{ asset('img/Admin/Informasi/'.$usa->gambar_if) }}" height="50" width="70" alt="Generic placeholder image">
                        <div class="media-body">
                        <a href="{{ route('bc.if_sm',$usa->id) }}" ><h6 class="mt-0 mb-1">{{ $usa->judul }}</h6></a>
                          <p>{!! substr(strip_tags($usa->isi),0, 150) !!}
                            <div class="text-right">
                                <a href="{{ route('ed.informasi',$usa->id) }}" type="submit">Edit</a>  <div class="bullet"></div>
                                <a href="" data-toggle="modal" data-target="#hapus{{ $usa->id }}">Hapus</a>
                          </div>
                          </p>
                        </div>
                    </li>
                    @endforeach
                  </ul>
                  <div class="card-footer text-right">
                      <a href="{{ route('sm.informasi_anda') }}">Lihat Semua <i class="fas fa-arrow-alt-circle-right"></i></a>
                  </div>
                </div>
              </div>
        </div>
    </div>

@endsection

@section('modal')
    {{-- Bagian Hapus informasi --}}
    @foreach ($Informasi as $usa)
    <div class="modal fade" id="hapus{{ $usa->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Hapus Informasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hp.informasi') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $usa->id }}"/>
                    <div class="form-group">
                        <p>Apakah Anda Yakin Ingin Menghapus <b>{{ $usa->judul }}</b> !</p>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#summernote').summernote({
          tabsize: 2,
          height: 200
        });
      </script>
@endpush
