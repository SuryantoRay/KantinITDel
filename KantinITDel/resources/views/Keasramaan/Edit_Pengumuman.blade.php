@extends('layouts.Master')

@section('title', 'Edit Pengumuman - Keasramaan')
@section('master_judul', 'Edit Pengumuman')

@push('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header">
              <h4>Edit Pengumuman</h4>
            </div>
            @foreach ($pengumuman as $pe)
            <form action="{{ route('pr.ed_pe_asrama') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $pe->id }}"/>
                <div class="card-body">
                <div class="form-group">
                    <label @error('judul') class="text-danger" role="alert" @enderror> Judul @error('judul') | {{ $message }} @enderror</label>
                    <input type="text" name="judul" class="form-control"
                    @if (old('judul'))
                        value="{{ old('judul') }}"
                    @else
                        value="{{ $pe->judul }}"
                    @endif
                    />
                </div>
                <div class="form-group">
                    <label @error('isi') class="text-danger" role="alert" @enderror> Isi @error('isi') | {{ $message }} @enderror</label>
                    <textarea name="isi" id="summernote"
                    @if (old('isi'))
                        value="{{ old('isi') }}"
                    @else
                        value="{{ $pe->isi }}"
                    @endif
                    >
                    @if (old('isi'))
                        {{ old('isi') }}
                    @else
                        {{ $pe->isi }}
                    @endif
                    </textarea>
                </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('h.pe_asrama') }}" class="btn btn-success">+ Tambah Pengumuman</a>
                    <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
            @endforeach
          </div>
    </div>


    <div class="col-12 col-md-12 col-lg-4">
        <div class="card">
            <div class="card-header">
              <h4>Pengumuman Anda</h4>
            </div>
            <div class="card-body">
                @foreach ($Pengumuman as $p)
                <li class="media">
                    <div class="media-body">
                      <a href="{{ route('bc.pe_asrama',$p->id) }}"><h5 class="mt-0 mb-1 primary">{{ $p->judul }}</h5></a>
                      <div class="text-left m-2">
                        <i class="fas fa-tags"> {{ $p->kepada }}</i> &nbsp
                        <i class="far fa-clock"> {{ $p->created_at }}</i>
                      </div>
                        <div class="text-right">
                            <a href="{{ route('ed.pe_asrama',$p->id) }}" type="submit">Edit</a> <div class="bullet"></div>
                            <a href="" data-toggle="modal" data-target="#hapus{{ $p->id }}">Hapus</a>
                      </div>
                      </p>
                    </div>
                </li>
                @endforeach
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('sm.pe_asrama') }}">Lihat Semua <i class="fas fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
{{-- Bagian Hapus pengumuman --}}
@foreach ($Pengumuman as $p)
<div class="modal fade" id="hapus{{ $p->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Hapus Pengumuman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('ha.pe_asrama') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $p->id }}"/>
                <div class="form-group">
                    <p>Apakah Anda Yakin Ingin Menghapus <b>{{ $p->judul }}</b> !</p>
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
