@extends('layouts.Master')

@section('title', 'Baca Informasi')
@section('master_judul', 'Informasi')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        @foreach ($Informasi as $pe)
        <div class="card-header">
            <h4>{{ $pe->judul }}</h4>
        </div>
        <div class="card-body">
            <div><img alt="image" src="{{ asset('img/Admin/Informasi/'.$pe->gambar_if) }}">
                <div class="slider-caption">
                  <div class="slider-title"></div>
                  <div class="slider-description"></div>
                </div>
            </div>
            <hr>
            <div>
                <i class="fas fa-tags"> {{ $pe->kategori }}</i> &nbsp &nbsp <i class="far fa-clock"> {{ $pe->created_at }}</i>
            </div>
            <hr>
            {!! $pe->isi !!}
        </div>
        @endforeach
        </div>
    </div>
</div>
@endsection

@section('modal')

@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
