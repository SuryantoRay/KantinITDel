@extends('layouts.Master')

@section('title', 'Baca Pengumuman')
@section('master_judul', 'Pengumuman')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        @foreach ($pengumuman as $pe)
        <div class="card-header">
            <h4>{{ $pe->judul }}</h4> &nbsp
            <i class="fas fa-tags"> {{ $pe->kepada }}</i> &nbsp &nbsp <i class="far fa-clock"> {{ $pe->created_at }}</i>
        </div>
        <div class="card-body">
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
