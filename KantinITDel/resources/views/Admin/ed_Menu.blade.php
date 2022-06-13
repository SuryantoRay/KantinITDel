@extends('layouts.Master')

@section('title', 'Edit Menu')
@section('master_judul', 'Edit Menu')

@push('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Menu</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        @foreach ($menu as $mu)
                        <form action="{{ route('pro.ed_menu') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $mu->id }}" />
                            <div class="form-group">
                                <label @error('isi') class="text-danger" role="alert" @enderror> Masukkan Menu Hari Ini @error('isi') | {{ $message }} @enderror</label>
                                <textarea name="isi" id="summernote"
                                    @if (old('isi'))
                                        value="{{ old('isi') }}"
                                    @else
                                        value="{{ $mu->isi }}"
                                    @endif
                                    >
                                    @if (old('isi'))
                                        {{ old('isi') }}
                                    @else
                                        {{ $mu->isi }}
                                    @endif
                                </textarea>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
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
          height: 300
        });
    </script>
@endpush
