    @section('title', 'Dashboard - Admin')
@section('master_judul', 'Dashboard | Admin')




{{-- Bagian 1 --}}
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Users</h4>
          </div>
          <div class="card-body">
            {{ $Data3 }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-list-alt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Informasi</h4>
          </div>
          <div class="card-body">
            {{ $Data2 }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Mahasiswa</h4>
          </div>
          <div class="card-body">
            @foreach ($Data as $d)
                {{ $d->jumlah_mahasiswa }}
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Seluruh Pengumuman</h4>
          </div>
          <div class="card-body">
            {{ $Data1 }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-12 col-lg-12">
        <h2 class="section-title">Informasi</h2>
        <p class="section-lead">
            <hr>
        </p>
    </div>



    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
              <h4>Menu Hari ini</h4>
            </div>
            @foreach ($menu as $m)
                <div class="card-body">
                    <?php
                        $ak = new DateTime();
                    ?>
                    @if ($ak->format('Y-m-d') == $m->created_at->format('Y-m-d'))
                        {!! $m->isi !!}
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header">
              <h6>Pengumuman</h6>
            </div>
            <div class="card-body">
                @foreach ($Pengumuman as $p)
                <li class="media">
                    <div class="media-body">
                      <a href="{{ route('bc.pe_sm',$p->id) }}"><h6 class="mt-0 mb-1 primary">{{ $p->judul }}</h6></a>
                      <div class="text-left m-2">
                        <i class="fas fa-tags"> {{ $p->kepada }}</i> &nbsp
                        <i class="far fa-clock"> {{ $p->created_at }}</i>
                      </div>
                      </p>
                    </div>
                </li>
                @endforeach
            </div>
            <div class="card-footer text-right">

            </div>
        </div>

</div>

