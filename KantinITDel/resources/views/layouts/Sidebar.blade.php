<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <img src="{{ asset ('img/na.png') }}" width="50" height="50" alt=""> &nbsp <a href="">Kantin IT Del</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href=""><img src="{{ asset ('img/na.png') }}" width="50" height="50" alt=""></a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li><a class="nav-link" href="/dashboard"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Starter</li>
          @if (Auth::user()->level == "admin")
          <li><a class="nav-link" href="{{ route('df.us') }}"><i class="fas fa-clipboard-list"></i> <span>Daftar Users</span></a></li>
          {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-newspaper"></i> <span>Membuat Informasi</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('l.informasi') }}">Lihat Semua Informasi</a></li>
              <li><a class="nav-link" href="{{ route('tm.kategori') }}">Tambah Kategori</a></li>
              <li><a class="nav-link" href="{{ route('h.informasi') }}">Tambah Informasi</a></li>
            </ul>
          </li> --}}
          <li><a class="nav-link" href="{{ route('l.informasi') }}"><i class="fas fa-newspaper"></i> <span>Lihat Semua Informasi</span></a></li>
          <li><a class="nav-link" href="{{ route('tm.kategori') }}"><i class="fas fa-newspaper"></i> <span>Tambah Kategori</span></a></li>
          <li><a class="nav-link" href="{{ route('h.informasi') }}"><i class="fas fa-newspaper"></i> <span>Tambah Informasi</span></a></li>
          <li><a class="nav-link" href="{{ route('tm_mnMk') }}"><i class="far fa-list-alt"></i> <span>Buat Menu Makanan Hari Ini</span></a></li>
          <li><a class="nav-link" href="{{ route('dt.mk') }}"><i class="fas fa-utensils"></i> <span>Detail Makan</span></a></li>
          <li><a class="nav-link" href="{{ route('h.crud_pengumuman') }}"><i class="fas fa-bullhorn"></i> <span>Membuat Pengumuman</span></a></li>
          <li><a class="nav-link" href="{{ route('tm.Admin') }}"><i class="fas fa-user-plus"></i> <span>Tambah Admin</span></a></li>
          <li><a class="nav-link" href="{{ route('profil.admin') }}"><i class="fas fa-id-card"></i> <span>Profil</span></a></li>
          @elseif (Auth::user()->level == "mahasiswa")
          <li><a class="nav-link" href="{{ route('li.ha_me') }}"><i class="far fa-list-alt"></i> <span>Lihat Menu Hari ini</span></a></li>
          <li><a class="nav-link" href="{{ route('ha.kantin') }}"><i class="fas fa-table"></i> <span>Gunakan Ruang Kantin</span></a></li>
          <li><a class="nav-link" href="{{ route('ha.alergi_makanan') }}"><i class="fas fa-paper-plane"></i> <span>Request Alergi</span></a></li>
          <li><a class="nav-link" href="{{ route('tm_iz_mk') }}"><i class="fas fa-envelope-open-text"></i> <span>Izin Tidak Makan</span></a></li>
          <li><a class="nav-link" href="{{ route('ha_pe_mahasiswa') }}"><i class="fas fa-bullhorn"></i> <span>Membuat Pengumuman</span></a></li>
          <li><a class="nav-link" href="{{ route('ha.pr_mahaiswa') }}"><i class="fas fa-id-card"></i> <span>Profil</span></a></li>
          @elseif (Auth::user()->level == "keasramaan")
          <li><a class="nav-link" href="{{ route('h.al_mkAcc') }}"><i class="fas fa-paper-plane"></i> <span>Lihat Daftar Alergi</span></a></li>
          <li><a class="nav-link" href="{{ route('iz.tdMK') }}"><i class="fas fa-vote-yea"></i> <span>Lihat Izin Tidak Makan</span></a></li>
          <li><a class="nav-link" href="{{ route('h.mnj_mh') }}"><i class="fas fa-users"></i> <span>Menajemen Jumlah Mahasiswa</span></a></li>
          <li><a class="nav-link" href="{{ route('h.pe_asrama') }}"><i class="fas fa-bullhorn"></i> <span>Membuat Pengumuman</span></a></li>
          <li><a class="nav-link" href="{{ route('h.pro_asrama') }}"><i class="fas fa-id-card"></i> <span>Profil</span></a></li>
          @elseif (Auth::user()->level == "ketertiban")
          <li><a class="nav-link" href="{{ route('piket') }}"><i class="fas fa-paint-roller"></i> <span>Petugas Piket</span></a></li>
          <li><a class="nav-link" href="{{ route('h.pePe_ktr') }}"><i class="fas fa-paperclip"></i> <span>Ajuan Pengumuman</span></a></li>
          <li><a class="nav-link" href="{{ route('h.peRu_ktn') }}"><i class="fas fa-vote-yea"></i> <span>Penggunaan Ruangan Kantin</span></a></li>
          <li><a class="nav-link" href="{{ route('h.pe_ktr') }}"><i class="fas fa-bullhorn"></i> <span>Membuat Pengumuman</span></a></li>
          <li><a class="nav-link" href="{{ route('pr.ktr') }}"><i class="fas fa-id-card"></i> <span>Profil</span></a></li>
          @endif
        </ul>
    </aside>
</div>
