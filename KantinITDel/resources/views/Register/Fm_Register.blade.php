<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="{{ asset ('img/na3.png') }}">
	<title>Register</title>
	<!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('node_modules/selectric/public/selectric.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
		<div id="app">
            <section class="section">
              <div class="container mt-5">
                <div class="row">
                  <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                      <img src="{{ asset('img/avatar.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                    </div>
                    <div class="card card-primary">
                      <div class="card-header"><h4>Register</h4></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <input type="hidden" name="level" value="{{ $id }}" />
                                  <div class="row">
                                    <div class="form-group col-6">
                                      <label for="first_name" @error('name') class="text-danger" role="alert" @enderror> Username @error('name') | {{ $message }} @enderror </label>
                                      <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="first_name" @error('tanggal_Lahir') class="text-danger" role="alert" @enderror> Tanggal Lahir @error('tanggal_Lahir') | {{ $message }} @enderror </label>
                                      <input type="date" class="form-control" name="tanggal_Lahir">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="first_name" @error('email') class="text-danger" role="alert" @enderror> Email @error('email') | {{ $message }} @enderror </label>
                                    <input id="email" type="email" class="form-control" name="email">
                                    <div class="invalid-feedback">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="form-group col-6">
                                        <label for="first_name" @error('password') class="text-danger" role="alert" @enderror> Password @error('password') | {{ $message }} @enderror </label>
                                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                                      <div id="pwindicator" class="pwindicator">
                                        <div class="bar"></div>
                                        <div class="label"></div>
                                      </div>
                                    </div>
                                    <div class="form-group col-6">
                                      <label for="password2" class="d-block">Password Confirmation</label>
                                      <input id="password2" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                  </div>
                                  <div class="row">
                                    @if ($id == "keasramaan")
                                    {{-- Jika Mendaftar Sebagai keasramaan --}}
                                    <div class="form-group col-6">
                                      <label @error('kedudukan') class="text-danger" role="alert" @enderror> Keasramaan di @error('kedudukan') | {{ $message }} @enderror</label>
                                      <select name="kedudukan" class="form-control selectric">
                                        <option value="">-- Pilih --</option>
                                        <option value="Asrama Phiniel">Asrama Pniel</option>
                                        <option value="Asrama Kapernaum">Asrama Kapernaum</option>
                                        <option value="Asrama betfage">Asrama betfage</option>
                                        <option value="Asrama Dantop">Asrama Dantop</option>
                                        <option value="Asrama Mamre">Asrama Mamre</option>
                                        <option value="Asrama Mahanaim">Asrama Mahanaim</option>
                                        <option value="Asrama Silo">Asrama Silo</option>
                                      </select>
                                    </div>
                                    @else
                                    <div class="form-group col-6">
                                    {{-- Jika Mendaftar Sebagai mahasiswa --}}
                                        <label @error('kedudukan') class="text-danger" role="alert" @enderror> Prodi @error('kedudukan') | {{ $message }} @enderror</label>
                                        <select name="kedudukan" class="form-control selectric">
                                          <option value="">-- Pilih --</option>
                                          <option value="DII Teknologi Informasi">DIII Teknologi Informasi</option>
                                          <option value="DIII Teknologi Komputer">DIII Teknologi Komputer</option>
                                          <option value="DIV Teknologi Rekayasa Perangkat Lunak">DIV Teknologi Rekayasa Perangkat Lunak</option>
                                          <option value="S1 Teknik Elektro">S1 Teknik Elektro</option>
                                          <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                          <option value="S1 Informatika">S1 Informatika</option>
                                          <option value="S1 Menajemen Rekayasa">S1 Menajemen Rekayasa</option>
                                          <option value="S1 Tehnik Bioproses">S1 Tehnik Bioproses</option>
                                        </select>
                                      </div>
                                    @endif
                                    <div class="form-group col-6">
                                        <label @error('jenis_Kelamin') class="text-danger" role="alert" @enderror> Jenis Kelamin @error('jenis_Kelamin') | {{ $message }} @enderror</label>
                                      <select name="jenis_Kelamin" class="form-control selectric">
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    @if ($id == 'keasramaan')
                                    {{-- Jika Mendaftar Sebagai keasramaan --}}
                                      <div class="form-group col-6">
                                        <label @error('tingkat') class="text-danger" role="alert" @enderror> Sebagai @error('tingkat') | {{ $message }} @enderror</label>
                                        <select name="tingkat" class="form-control selectric">
                                            <option value="">-- Pilih --</option>
                                            <option value="Bapak Asrama">Bapak Asrama</option>
                                            <option value="Ibu Asrama">Ibu Asrama</option>
                                            <option value="Abang Asrama">Abang Asrama</option>
                                            <option value="Kakak Asrama">Kakak Asrama</option>
                                        </select>
                                      </div>
                                    @else
                                    {{-- Jika Mendaftar Sebagai mahasiswa --}}
                                      <div class="form-group col-6">
                                        <label @error('tingkat') class="text-danger" role="alert" @enderror> Angkatan @error('tingkat') | {{ $message }} @enderror</label>
                                        <input type="text" name="tingkat" class="form-control">
                                      </div>
                                    @endif
                                    <div class="form-group col-6">
                                        <label @error('alamat') class="text-danger" role="alert" @enderror> ALamat @error('alamat') | {{ $message }} @enderror</label>
                                      <input type="text" name="alamat" class="form-control">
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
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-block">Ke Halaman Login</a>
                                  </div>
                                </form>
                              </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
        </div>
    <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
</body>
</html>
