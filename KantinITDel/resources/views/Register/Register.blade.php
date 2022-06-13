<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="{{ asset ('img/na3.png') }}">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    <div class="content row sortable-card" style="margin: 12% auto;">
        <div class="col-12 col-md-12 col-lg-4">
          <div class="card card-primary">
            <div class="card-header">
              <h4>Daftar Sebagai Ketertiban</h4>
            </div>
            <div class="card-body">
                <p> <i class="fas fa-users icon"></i> </code></p>
                <a href="{{ route('daftar', 'ketertiban') }}" class="btn btn-primary">Daftar Sekarang </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
          <div class="card card-danger">
            <div class="card-header">
              <h4>Daftar Sebagai Mahasiswa</h4>
            </div>
            <div class="card-body">
                <p> <i class="fas fa-users icon"></i> </code></p>
                <a href="{{ route('daftar', 'mahasiswa') }}" class="btn btn-primary">Daftar Sekarang </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
          <div class="card card-warning">
            <div class="card-header">
              <h4>Daftar Sebagai Keasramaan</h4>
            </div>
            <div class="card-body">
              <p> <i class="fas fa-users icon"></i> </code></p>
              <a href="{{ route('daftar', 'keasramaan') }}" class="btn btn-primary">Daftar Sekarang </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-12">
          <a href="{{ route('login') }}" class="btn btn-primary">Ke Halaman Login </a>
        </div>
    </div>


  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>


  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
