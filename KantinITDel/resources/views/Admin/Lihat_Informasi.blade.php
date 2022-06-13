@extends('layouts.Master')

@section('title', 'Semua Informasi')
@section('master_judul', 'Informasi')

@push('css')

@endpush

@section('content')
<div class="row">
    @foreach ($User as $i)
    <?php
        $awal  = new DateTime($i->created_at);
        $akhir = new DateTime(); // Waktu sekarang
        $diff  = $awal->diff($akhir);
    ?>
    <div class="col-12 col-md-6 col-lg-4">
        <article class="article article-style-c">
          <div class="article-header">
            <div class="article-image" data-background="{{ asset('img/Admin/Informasi/'.$i->gambar_if) }}" style="background-image: url(&quot;../assets/img/news/img13.jpg&quot;);">
            </div>
          </div>
          <div class="article-details">
            <div class="article-category"><a href="#">{{ $i->kategori }}</a> <div class="bullet"></div> <a href="#">{{ $diff->d }} Days</a></div>
            <div class="article-title">
              <h2><a href="{{ route('bc.if_sm',$i->id) }}">{{ $i->judul }}</a></h2>
            </div>
            <p>{!! substr(strip_tags($i->isi),0, 200) !!}</p>
            <div class="article-user">
              @if ($i->gambar == 0)
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}">
              @else
                <img alt="image" height="50" width="50" src="{{ asset('img/Admin/Profil/'.$i->gambar) }}">
              @endif
              <div class="article-user-details">
                <div class="user-detail-name">
                  <a href="#">{{ $i->name }}</a>
                </div>
                <div class="text-job">Kantin IT Del</div>
              </div>
            </div>
          </div>
        </article>
      </div>
    @endforeach
</div>
@endsection

@section('modal')

@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
