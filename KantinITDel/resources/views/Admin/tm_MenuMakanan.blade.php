@extends('layouts.Master')

@section('title', 'Request Kantin')
@section('master_judul', 'Penggunaan Ruangan Kantin')

@push('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Menu Makanan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="{{ route('tm_MK') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label @error('isi') class="text-danger" role="alert" @enderror> Masukkan Menu Hari Ini @error('isi') | {{ $message }} @enderror</label>
                                <textarea name="isi" id="summernote">{{ old('isi') }}</textarea>
                            </div>
                            <div class="card-footer text-right">
                                <input type="submit" class="btn btn-primary"value="Submit">
                                <button class="btn btn-secondary" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-12">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Menu</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                      <th scope="col">Pembuat</th>
                                      <th scope="col">Tanggal</th>
                                      <th scope="col">Komentar</th>
                                      <th scope="col">Opsi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                @foreach ($menu as $m)
                                  <form action="" method="post">
                                      <tr>
                                        <td>{{ $m->name }}</td>
                                        <td>
                                            <?php
                                                $tgl = date_create($m->created_at);
                                                $formatted_date = date_format($tgl, "d F Y");
                                                echo $formatted_date;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="{{ route('hal.kom',$m->menu_id) }}" class="btn btn-success"><i class="fas fa-comments"></i> Komen</a>
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-info" data-toggle="modal" data-target="#detail{{ $m->menu_id }}">Detail</a>
                                            @if ($m->user_id == auth::user()->id)
                                                <a href="{{ route('hal.ed_menu',$m->menu_id) }}" class="btn btn-primary"> Edit</a>
                                                <a href="" class="btn btn-danger" data-toggle="modal" data-target="#hapus{{ $m->menu_id }}">Hapus</a>
                                            @endif
                                        </td>
                                       </tr>
                                  </form>
                                  @endforeach
                               </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
 {{-- Bagian Hapus Menu --}}
 @foreach ($menu as $m)
 <div class="modal fade" id="hapus{{ $m->menu_id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="staticBackdropLabel">Hapus Menu</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <form action="{{ route('ha_MN') }}" method="post" enctype="multipart/form-data">
                 {{ csrf_field() }}
                 <input type="hidden" name="id" value="{{ $m->menu_id }}"/>
                 <div class="form-group">
                     <p>Apakah Anda Yakin Ingin Menghapus Menu !</p>
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

 {{-- Detail --}}
 @foreach ($menu as $m)
 <div class="modal fade" id="detail{{ $m->menu_id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <div class="form-group">
                 <label for="my-input">Pembuat</label>
                 <label for="my-input" class="form-control">{{ $m->name }}</label>
             </div>
             <div class="form-group">
                <label for="my-input">Tanggal</label>
                <label for="my-input" class="form-control">
                    <?php
                        $tgl = date_create($m->created_at);
                        $formatted_date = date_format($tgl, "d F Y");
                        echo $formatted_date;
                    ?>
                </label>
            </div>
            <div class="form-group">
                <label for="my-input">isi</label><br>
                <label for="my-input">{!! $m->isi !!}</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
            </div>
         </div>
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
