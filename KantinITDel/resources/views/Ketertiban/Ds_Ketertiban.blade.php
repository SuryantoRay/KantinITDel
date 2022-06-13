@section('title', 'Dashboard - Ketertiban')
@section('master_judul', 'Dashboard | Ketertiban')


{{-- Bagian 1 --}}
<div class="row">
    <div class="col-12 col-md-12 col-lg-8">
        <div class="section-body">
            <h2 class="section-title">Informasi</h2>


            <div class="row">
                @foreach ($Informasi as $if)
                <?php
                    // $ak = new DateTime();
                    // if ($ak->format('Y-m-d') == $if->created_at->format('Y-m-d')) {
                    //     echo "hore";
                    // }
                    $awal  = new DateTime($if->created_at);
                    $akhir = new DateTime(); // Waktu sekarang
                    $diff  = $awal->diff($akhir);
                ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <article class="article">
                      <div class="article-header">
                        <div class="article-image" data-background="{{ asset('img/Admin/Informasi/'.$if->gambar_if) }}" style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
                        </div>
                        <div class="article-title">
                          <h2><a href="{{ route('bc.if_sm',$if->id) }}">{{ $if->judul }}</a></h2>
                        </div>
                      </div>
                      <div class="article-details">
                        <b><div class="article-category">{{ $if->kategori}} <div class="bullet"></div> {{ $diff->d }} Days</div></b>
                        <p>{!! substr(strip_tags($if->isi),0, 100) !!}</p>
                        <div class="article-cta">
                          <a href="{{ route('bc.if_sm',$if->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                      </div>
                    </article>
                  </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-4">
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

</div>


