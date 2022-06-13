@extends('layouts.Master')

@section('title', 'Menu Makanan')
@section('master_judul', 'Makanan Hari ini')

@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
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

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Berikan Komentar</h4>
                </div>
                <form action="{{ route('br.komen') }}" method="post">
                    @csrf
                    @foreach ($menu as $m)
                        <?php
                            $ak = new DateTime();
                        ?>
                        @if ($ak->format('Y-m-d') == $m->created_at->format('Y-m-d'))
                            <input type="hidden" name="id" value="{{ $m->id }}"/>
                        @endif
                    @endforeach
                    <div class="card-body">
                        <div class="form-group">
                            <label @error('nama') class="text-danger" role="alert" @enderror> Nama @error('nama') | {{ $message }} @enderror</label>
                            <input id="my-input" class="form-control" type="text" name="nama">
                        </div>
                        <div class="form-group">
                            <label @error('komen') class="text-danger" role="alert" @enderror> Komentar @error('komen') | {{ $message }} @enderror</label>
                            <textarea name="komen" class="form-control" id="" cols="30" rows="10">{{ old('komen') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Komentar</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($menu as $m)
                        <?php
                            $ak = new DateTime();
                        ?>
                        @foreach ($komen as $k)
                        @if ($k->status == "aktif" && $k->menu_id == $m->id && $ak->format('Y-m-d') == $m->created_at->format('Y-m-d'))
                        <li class="media">
                            <img class="mr-3" src="{{ asset('assets/img/avatar/avatar-4.png') }}" height="50" width="70" alt="Generic placeholder image">
                            <div class="media-body">
                            <h6 class="mt-0 mb-1">{{ $k->nama }}</h6>
                            <label style="font-size:10px; color:rgb(148, 144, 144)">{{ $k->created_at->format('d M Y') }} pukul {{ $k->created_at->format('H:i') }}</label>
                              <p>
                                {{ $k->komen }}
                              </p>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endforeach
                      </ul>
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
