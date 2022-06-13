@extends('layouts.Master')
@push('css')

@endpush

@section('content')
<div class="section-body">
        @if (auth()->user()->level == "admin")
            @include('Admin.Ds_admin')
        @elseif (auth()->user()->level == "keasramaan")
            @include('Keasramaan.Ds_keasramaan')
        @elseif (auth()->user()->level == "ketertiban")
            @include('Ketertiban.Ds_Ketertiban')
        @elseif (auth()->user()->level == "mahasiswa")
            @include('Mahasiswa.Ds_Mahasiswa')
        @endif
</div>
@endsection

@section('modal')
    {{-- Modal hapus --}}


@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
