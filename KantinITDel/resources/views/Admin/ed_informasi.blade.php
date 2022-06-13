@extends('layouts.Master')

@section('title', 'Edit Informasi - Admin')
@section('master_judul', 'Edit Informasi')

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
            @foreach ($Informasi as $if)
            <form action="{{ route('ed.p_informasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $if->id }}" />
                <div class="card-body">
                <div class="form-group">
                    <label @error('judul') class="text-danger" role="alert" @enderror> Judul @error('judul') | {{ $message }} @enderror</label>
                    <input type="text"
                    @if (old('judul'))
                        value="{{ old('judul') }}"
                    @else
                        value="{{ $if->judul }}"
                    @endif
                    name="judul" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select  name="kategori" class="form-control">
                        <option value="{{ $if->kategori }}">{{ $if->kategori }}</option>
                        @foreach ($Kategori as $k)
                            @if ($if->kategori == $k->kategori)

                            @elseif ($if->kategori != $k->kategori)
                                <option value="{{ $k->kategori }}">{{ $k->kategori }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label @error('isi') class="text-danger" role="alert" @enderror> Isi @error('isi') | {{ $message }} @enderror</label>
                    <textarea name="isi" id="summernote"
                    @if (old('isi'))
                        value="{{ old('isi') }}"
                    @else
                        value="{{ $if->isi }}"
                    @endif
                    >{{ $if->isi }}</textarea>
                </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Update</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
            @endforeach
          </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-4">
        @foreach ($Informasi as $if)
        <div class="card">
            <form action="{{ route('ed.g_informasi') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="{{ $if->id }}">
            <div class="card-header">
              <h4 @error('gambar_if') class="text-danger" role="alert" @enderror> Gambar @error('gambar_if') | {{ $message }} @enderror</h4>
            </div>
            @csrf
            <div class="card-body">
              <div class="gallery gallery-fw" data-item-height="100">
                <div class="gallery-item" data-image="{{ asset('img/Admin/Informasi/'.$if->gambar_if) }}" data-title="{{ $if->judul }}" title="{{ $if->judul }}" style="height: 300px; background-image: url(&quot;../assets/img/news/img09.jpg&quot;);"></div>
            </div>
            <div class="form-group">
                <input class="form-control" type="file" name="gambar_if">
            </div>
            <div class="modal-footer">
                <input type="submit" value="Edit Gambar" class="btn btn-primary">
            </div>
          </div>
        </form>
        @endforeach
      </div>
</div>
@endsection

@section('modal')

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
