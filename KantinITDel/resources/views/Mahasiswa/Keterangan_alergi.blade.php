@extends('layouts.Master')

@section('title', 'Request Alergi')
@section('master_judul', 'Alergi Makanan')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-6">
        <div class="section-body">
            <h2 class="section-title">Perhatikan</h2>
            <p class="section-lead">
                <ul>
                    <li>Dalam Membuat Request Alergi Harus disertakan Bukti berupa foto surat keterangan Rumaha sakit.</li>
                    <li>Laporan anda akan di terima jika keterangan dari laporan anda sudah berubah dari 'menunggu' menjadi 'diterima'.</li>
                    <li>Anda tidak dapat mengubah data yang sudah anda masukkan jika sudah mengirim. Jadi Pastikan datanya lengkap dan benar.</li>
                </ul>
            </p>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Keterangan Alergi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tm_alergi') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label @error('alergi') class="text-danger" role="alert" @enderror> Nama Alergi @error('alergi') | {{ $message }} @enderror</label>
                            <input type="text" name="alergi" class="form-control" value="{{ old('alergi') }}" />
                        </div>
                        <div class="form-group">
                            <label @error('gambar_ar') class="text-danger" role="alert" @enderror> Foto Keterangan Rumah Sakit @error('gambar_ar') | {{ $message }} @enderror</label>
                            <input type="file" name="gambar_ar" class="form-control" value="{{ old('gambar_ar') }}" />
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-lg-6">
        @foreach ($Alergi as $al)
        <div class="card">
            <div class="card-header">
            <h4>Surat Keterangan Dokter |
                @if ($al->status == "diterima")
                    <div class="badge badge-success"> diterima</div>
                @elseif ($al->status == "ditolak")
                    <div class="badge badge-danger"> ditolak</div>
                @elseif ($al->status == "menunggu")
                    <div class="badge badge-warning"> menunggu</div>
                @endif
            </h4>
            </div>
            @csrf
            <div class="card-body">
            <div class="gallery gallery-fw" data-item-height="100">
                <a href="{{ asset('img/Mahasiswa/Alergi/'.$al->gambar_ar) }}"><div class="gallery-item" data-image="{{ asset('img/Mahasiswa/Alergi/'.$al->gambar_ar) }}" data-title="" title="" style="height: 200px; background-image: url(&quot;../assets/img/news/img09.jpg&quot;);"></div></a>
            </div>
            <div class="form-group">
                <label for="">Nama Alergi : {{ $al->alergi }}</label>
            </div>
        </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('modal')

@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
