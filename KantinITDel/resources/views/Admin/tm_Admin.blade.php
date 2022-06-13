@extends('layouts.Master')

@section('title', 'TambahKan Admin')
@section('master_judul', 'Tambah Admin')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card card-primary">
            <div class="card-header"><h4>Tambah Admin</h4></div>

            <div class="card-body">
              <form method="POST" action="{{ route('tm.pro_Admin') }}">
                @csrf
                  <input type="hidden" name="level" value="admin" />
                <div class="row">
                  <div class="form-group col-6">
                    <label @error('name') class="text-danger" role="alert" @enderror> Username @error('name') | {{ $message }} @enderror </label>
                    <input id="first_name" type="text" class="form-control" name="name" autofocus="">
                  </div>
                  <div class="form-group col-6">
                    <label @error('tanggal_Lahir') class="text-danger" role="alert" @enderror> Tanggal_Lahir @error('tanggal_Lahir') | {{ $message }} @enderror </label>
                    <input id="last_name" type="date" class="form-control" name="tanggal_Lahir">
                  </div>
                </div>

                <div class="form-group">
                  <label @error('email') class="text-danger" role="alert" @enderror> Email @error('email') | {{ $message }} @enderror </label>
                  <input id="email" type="email" class="form-control" name="email">
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-12">
                    <label @error('password') class="text-danger" role="alert" @enderror> Password @error('password') | {{ $message }} @enderror </label>
                    <input type="password" class="form-control" name="password">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label @error('alamat') class="text-danger" role="alert" @enderror> Alamat @error('alamat') | {{ $message }} @enderror </label>
                    <input type="text" name="alamat" class="form-control" id="">
                  </div>
                  <div class="form-group col-6">
                    <label @error('jenis_Kelamin') class="text-danger" role="alert" @enderror> Jenis Kelamin  @error('jenis_Kelamin') | {{ $message }} @enderror </label>
                    <select name="jenis_Kelamin" class="form-control">
                      <option value="L">Laki - Laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label @error('tingkat') class="text-danger" role="alert" @enderror> Jenjang @error('tingkat') | {{ $message }} @enderror </label>
                    <select name="tingkat" id="" class="form-control">
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                  </div>
                  <div class="form-group col-6">
                    <label @error('kedudukan') class="text-danger" role="alert" @enderror> Jurusan @error('kedudukan') | {{ $message }} @enderror </label>
                    <input type="text" name="kedudukan" class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
              </form>
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

@endpush
