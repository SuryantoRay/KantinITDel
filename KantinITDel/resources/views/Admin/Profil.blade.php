@extends('layouts.Master')

@section('title', 'Profil - Admin')
@section('master_judul', 'Profil Anda')

@push('css')

@endpush

@section('content')
<div class="row">
    <div class="section-body">

        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-5">
            @foreach ($User as $us)
            <div class="card profile-widget">
                <div class="profile-widget-header">
                  @if ($us->gambar == 0)
                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-3.png') }}" class="rounded-circle profile-widget-picture">
                  @else
                    <img alt="image" src="{{ asset('img/Admin/Profil/'.$us->gambar) }}" height="110" width="110" class="rounded-circle profile-widget-picture">
                  @endif
                  <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Posts</div>
                        <div class="profile-widget-item-value">{{ $Post }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Pengumuman</div>
                      <div class="profile-widget-item-value">{{ $Pengumuman }}</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Umur </div>
                      <div class="profile-widget-item-value">{{ $Umur }}</div>
                    </div>
                  </div>
                </div>
                <div class="profile-widget-description">
                  <div class="profile-widget-name">{{ $us->name }}<div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Admin</div></div>
                  "Kita menilai diri kita dengan cara mengukur dari apa yang kita rasa mampu untuk kerjakan, sedangkan orang lain mengukur kita dengan mengukur dari apa yang telah kita lakukan." - <b>Henry Wadsworth Longfellow</b>
                </div>
                <div class="card-footer text-center">
                  <div class="font-weight-bold mb-2"></div>

                </div>
              </div>
            @endforeach
          </div>
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Edit Profil</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Edit Gambar</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          @foreach ($User as $us)
                            <form action="{{ route('ed.p_admin') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                      <div class="form-group col-md-6 col-12">
                                        <label @error('name') class="text-danger" role="alert" @enderror> Username @error('name') | {{ $message }} @enderror</label>
                                        <input type="text" class="form-control" name="name"
                                        @if (old('name'))
                                            value="{{ old('name') }}"
                                        @else
                                            value="{{ $us->name }}"
                                        @endif
                                        >
                                      </div>
                                      <div class="form-group col-md-6 col-12">
                                        <label @error('tanggal_Lahir') class="text-danger" role="alert" @enderror> Tanggal Lahir @error('tanggal_Lahir') | {{ $message }} @enderror</label>
                                        <input type="date" class="form-control" name="tanggal_Lahir" value="{{ $us->tanggal_Lahir }}">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-6 col-12">
                                        <label>Jenis Kelamin</label>
                                        <select  name="jenis_Kelamin" class="form-control">
                                            <option value="{{ $us->jenis_Kelamin }}">
                                                @if ($us->jenis_Kelamin === 'L')
                                                    Laki - Laki
                                                @elseif ($us->jenis_Kelamin === 'P')
                                                    Perempuan
                                                @endif
                                            </option>
                                            @if ($us->jenis_Kelamin === 'L')
                                                <option value="P">Perempuan</option>
                                            @elseif ($us->jenis_Kelamin === 'P')
                                                <option value="L">Laki - Laki</option>
                                            @endif
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6 col-12">
                                        <label>Alamat</label>
                                        <input type="text" class="form-control" name="alamat"
                                        @if (old('alamat'))
                                            value="{{ old('alamat') }}"
                                        @else
                                            value="{{ $us->alamat }}"
                                        @endif
                                        >
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                          <label>Jenjang</label>
                                          <select  name="tingkat" class="form-control">
                                              <option value="{{ $us->tingkat }}">{{ $us->tingkat }}</option>
                                              @if ($us->tingkat === 'D3')
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                              @elseif ($us->tingkat === 'D4')
                                                <option value="D3">D3</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                              @elseif ($us->tingkat === 'S1')
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                              @elseif ($us->tingkat === 'S2')
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S3">S3</option>
                                              @elseif ($us->tingkat === 'S3')
                                                <option value="D3">D3</option>
                                                <option value="D4">D4</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                              @endif
                                          </select>
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                          <label @error('kedudukan') class="text-danger" role="alert" @enderror> Jurusan @error('kedudukan') | {{ $message }} @enderror</label>
                                          <input type="text" class="form-control" name="kedudukan"
                                          @if (old('kududukan'))
                                            value="{{ old('kududukan') }}"
                                          @else
                                            value="{{ $us->kedudukan }}"
                                          @endif
                                          >
                                        </div>
                                      </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                          @endforeach
                      </div>
                      <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        <form action="{{ route('ed.g_admin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Edit Gambar</h4>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                <div class="form-group col-md-12 col-12">
                                  <label @error('gambar') class="text-danger" role="alert" @enderror> Gambar @error('gambar') | {{ $message }} @enderror</label>
                                  <input class="form-control" type="file" name="gambar">
                                </div>
                              </div>
                          </div>
                          <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Simpan Gambar</button>
                        </div>
                        </form>
                      </div>
                    </div>
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

@endpush
