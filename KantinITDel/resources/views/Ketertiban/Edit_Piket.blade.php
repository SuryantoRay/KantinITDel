@extends('layouts.Master')

@section('title', 'Daftar Piket')
@section('master_judul', 'Pembuatan Daftar Piket')

@push('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-8">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Petugas Piket</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        @foreach ($piket as $pe)
                        <form action="{{ route('pro.ed_pkt') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pe->id }}"/>
                            <div class="form-group">
                                <label @error('keterangan') class="text-danger" role="alert" @enderror> Keterangan @error('keterangan') | {{ $message }} @enderror</label>
                                <input type="text" name="keterangan" class="form-control"
                                @if (old('keterangan'))
                                    value="{{ old('keterangan') }}"
                                @else
                                    value="{{ $pe->keterangan }}"
                                @endif
                            />
                            </div>
                            <div class="form-group">
                                <label @error('isi') class="text-danger" role="alert" @enderror> Masukkan Menu Hari Ini @error('isi') | {{ $message }} @enderror</label>
                                <textarea name="isi" id="summernote"
                                @if (old('isi'))
                                    value="{{ old('isi') }}"
                                @else
                                    value="{{ $pe->isi }}"
                                @endif
                                >
                                @if (old('isi'))
                                    {{ old('isi') }}
                                @else
                                    {{ $pe->isi }}
                                @endif
                                </textarea>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-4">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Daftar Piket</h4>
                </div>
                <div class="card-body">
                    @foreach ($piket1 as $p)
                    <li class="media">
                        <div class="media-body">
                        <a href="{{ route('bc.pkt',$p->id) }}"><h6 class="mt-0 mb-1 primary">{{ $p->keterangan }}</h6></a>
                        <div class="text-left m-2">
                            <i class="far fa-clock"> {{ $p->created_at }}</i>
                        </div>
                            <div class="text-right">
                                <a href="{{ route('ed.pkt_ktr',$p->id) }}" type="submit">Edit</a> <div class="bullet"></div>
                                <a href="" data-toggle="modal" data-target="#hapus{{ $p->id }}">Hapus</a>
                        </div>
                        </p>
                        </div>
                    </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
 {{-- Bagian Hapus Menu --}}
 @foreach ($piket1 as $p)
 <div class="modal fade" id="hapus{{ $p->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="staticBackdropLabel">Hapus Piket</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <form action="{{ route('hp.pkt') }}" method="post" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="id" value="{{ $p->id }}"/>
                 <div class="form-group">
                     <p>Apakah Anda Yakin Ingin Menghapus Piket !</p>
                 </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-primary" data-dismiss="modal">Batalkan</button>
                     <input type="submit" class="btn btn-danger" value="Hapus">
                 </div>
             </form>
         </div>
     </div>
   </div>
   @endforeach
@endsection

@push('top-script')

@endpush

@push('page-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#summernote').summernote({
          tabsize: 2,
          height: 300
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
