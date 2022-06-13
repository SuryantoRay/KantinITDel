<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
      </ul>
    </form>
    <ul class="navbar-nav navbar-right">
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        @if (Auth::user()->gambar == "0")
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
        @else
            @if (Auth::user()->level == "admin")
                <img alt="image" height="35" width="40" src="{{ asset('img/Admin/Profil/'.Auth::user()->gambar) }}" class="rounded-circle mr-1">
            @elseif (Auth::user()->level == "mahasiswa")
                <img alt="image" height="35" width="40" src="{{ asset('img/Mahasiswa/Profil/'.Auth::user()->gambar) }}" class="rounded-circle mr-1">
            @elseif (Auth::user()->level == "keasramaan")
                <img alt="image" height="35" width="40" src="{{ asset('img/Keasramaan/Profil/'.Auth::user()->gambar) }}" class="rounded-circle mr-1">
            @elseif (Auth::user()->level == "ketertiban")
                <img alt="image" height="35" width="40" src="{{ asset('img/Ketertiban/Profil/'.Auth::user()->gambar) }}" class="rounded-circle mr-1">
            @endif
        @endif
        <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-title">Logged in 5 min ago</div>
          <a
          @if (Auth::user()->level == "admin")
            href="{{ route('profil.admin') }}"
          @elseif (Auth::user()->level == "mahasiswa")
            href="{{ route('ha.pr_mahaiswa') }}"
          @elseif (Auth::user()->level == "keasramaan")
            href="{{ route('h.pro_asrama') }}"
          @elseif (Auth::user()->level == "ketertiban")
            href="{{ route('pr.ktr') }}"
          @endif
          class="dropdown-item has-icon">
            <i class="far fa-user"></i> Profile
          </a>
          <div class="dropdown-divider"></div>
          {{-- logout auth --}}
          <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </div>
      </li>
    </ul>
  </nav>
