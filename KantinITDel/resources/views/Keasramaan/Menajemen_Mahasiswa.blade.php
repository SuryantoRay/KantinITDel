@extends('layouts.Master')

@section('title', 'Manajemen Mahaiswa')
@section('master_judul', 'Manajemen Mahaiswa')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-0 col-lg-3">
    </div>
    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
              <h4>Data Seluruh Mahasiswa</h4>
            </div>
            @foreach ($Data as $d)
            <form action="{{ route('ed.dt_mh') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $d->id }}"/>
                <div class="card-body">
                <div class="form-group">
                    <label @error('judul') class="text-danger" role="alert" @enderror> Jumlah Mahasiswa @error('judul') | {{ $message }} @enderror</label>
                    <label class="form-control">{{ $d->jumlah_mahasiswa }}</label>
                </div>
                <div class="form-group">
                    <label @error('isi') class="text-danger" role="alert" @enderror> Laki-Laki @error('isi') | {{ $message }} @enderror</label>
                    <input type="number" name="laki_laki" class="form-control"
                    @if (old('laki_laki'))
                        value="{{ old('laki_laki') }}"
                    @else
                        value="{{ $d->laki_laki }}"
                    @endif
                    />
                </div>
                <div class="form-group">
                    <label @error('isi') class="text-danger" role="alert" @enderror> Perempuan @error('isi') | {{ $message }} @enderror</label>
                    <input type="number" name="perempuan" class="form-control"
                    @if (old('perempuan'))
                    value="{{ old('perempuan') }}"
                    @else
                        value="{{ $d->perempuan }}"
                    @endif
                />
                </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary mr-1" type="submit">Edit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </form>
            @endforeach
          </div>
    </div>
    <div class="col-12 col-md-0 col-lg-3">
    </div>
</div>
@endsection

@section('modal')

@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
