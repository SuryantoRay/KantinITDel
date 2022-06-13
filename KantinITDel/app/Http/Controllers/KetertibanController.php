<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Pengumuman;
use App\Piket;
use App\Ruangan_Kantin;
use Carbon\Carbon;

class KetertibanController extends Controller
{
    public function profil_ketertiban(){
        $User = User::find(Auth::user()->id);
        $pe = Pengumuman::where('user_id', Auth::user()->id)->count();

        // umur
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($User->tanggal_Lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        $User = User::where('id', Auth::user()->id)->get();

        return view('Ketertiban.Profil_Ketertiban', ['User' => $User, 'Umur' => $age, 'Pengumuman' => $pe]);
    }

    public function edit_profil_ketertiban(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255|min:8',
            'kedudukan' => 'required',
            'tingkat' => 'required',
            'alamat' => 'required',
            'jenis_Kelamin' => 'required',
            'tanggal_Lahir' => 'required',
        ],[
            'name.required' => 'Harus Di Isi',
            'name.string' => 'Harus Berupa String',
            'name.max' => 'Max 255 masukan',
            'name.min' => 'Minimal 8 masukan',
            'kedudukan.required' => 'Harus Di Isi',
            'tanggal_Lahir.required' => 'Harus Di Isi',
            'jenis_keterangan.required' => 'Harus Di Isi',
            'tingkat.required' => 'Harus Di Isi',
            'alamat.required' => 'Harus Di Isi',
        ]);

        $User = User::find(Auth::user()->id);
        if ($User->name === $request->name &&
            $User->alamat === $request->alamat &&
            $User->tanggal_Lahir === $request->tanggal_Lahir &&
            $User->jenis_Kelamin === $request->jenis_Kelamin &&
            $User->kedudukan === $request->kedudukan &&
            $User->tingkat === $request->tingkat){
                return redirect()->back()->with('info', 'Anda tidak mengubah data apapun');
            }

        $User->name = $request->name;
        $User->alamat = $request->alamat;
        $User->jenis_Kelamin = $request->jenis_Kelamin;
        $User->kedudukan = $request->kedudukan;
        $User->tingkat = $request->tingkat;
        $User->tanggal_Lahir = $request->tanggal_Lahir;
        $User->save();

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    public function edit_gambar_ketertiban(Request $request){
        $User = User::find(Auth::user()->id);

        if($request->gambar == null){
            return redirect()->back()->with('info', 'Anda tidak mengubah data sedikit pun');
        }

        $this->validate($request, [
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'gambar.required' => 'Gambar Harus Di Isi',
            'gambar.file' => 'Anda Hanya Dapat Upload File',
            'gambar.image' => 'Anda Hanya Dapat Upload Image',
            'gambar.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar.max' => 'Gambar Berukuran MAX 2MB',
        ]);

        if($User->gambar === "0"){
            $file = $request->file('gambar');
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'img/Ketertiban/Profil';
            $file->move($tujuan_upload,$nama_file);

            $User->gambar = $nama_file;
            $User->save();

            return redirect()->back()->with('success', 'Berhasil mengubah Gambar');
        }
        else {
            $gambar_awal = $User->gambar;
            $pi = [
                'gambar' => $gambar_awal,
            ];
            $request->gambar->move(public_path().'/img/Ketertiban/Profil', $gambar_awal);
            $User->update($pi);

            return redirect()->back()->with('success', 'Berhasil mengubah Gambar');
        }
    }

    public function pengumuman_ketertiban(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Ketertiban.Pengumuman_Ketertiban', ['Pengumuman' => $pengumuman]);
    }

    public function buat_pengumuman_ketertiban(Request $request){
        $this->validate($request, [
            'judul' => 'required|min:4|max:200',
            'isi' => 'required|min:50',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 4 Digit',
            'judul.max' => 'Maximal 200 Digit',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
        ]);

        $status = "aktif";
        $kepada = "Mahasiswa";

        Pengumuman::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $status,
            'kepada' => $kepada,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Pengumuman');
    }

    public function edit_pengumuman_ketertiban($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $Pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Ketertiban.Edit_Pengumuman', ['pengumuman' => $pengumuman, 'Pengumuman' => $Pengumuman]);
    }

    public function proEdit_pengumuman_ketertiban(Request $request){
        $pengumuman = Pengumuman::find($request->id);

        if($request->judul === $pengumuman->judul && $request->isi === $pengumuman->isi){
            return redirect()->back()->with('info', 'Anda tidak mengubah apapun');
        }

        $this->validate($request, [
            'judul' => 'required|min:4|max:200',
            'isi' => 'required|min:50',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 4 Digit',
            'judul.max' => 'Maximal 200 Digit',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
        ]);

        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->save();

        return redirect()->back()->with('success', 'Berhasil Edit Pengumuman');
    }

    public function hapus_pengumuman_ketertiban(Request $request) {
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Berhasil hapus pengumuman');
    }

    public function baca_pengumuman_ketertiban($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('Ketertiban.Baca_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function semua_pengumuman_ketertiban(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Ketertiban.Semua_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function pengajuan_Ruangan_kantin(){
        $ruangan = DB::table('users')
        ->rightJoin('ruang_kantin', 'ruang_kantin.user_id', '=' , 'users.id')
        ->orderBy('ruang_kantin.created_at', 'DESC')
        ->get();

        return view('Ketertiban.Pengajuan_Ruangan', ['ruangan' => $ruangan]);
    }

    public function ubah_status_ruangan1(Request $request){
        $ruangan = Ruangan_Kantin::find($request->id);
        if ($ruangan->aksi == "diterima"){
            $status = "ditolak";
            $ruangan->aksi = $status;
            $ruangan->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($ruangan->aksi == "ditolak"){
            $status = "diterima";
            $ruangan->aksi = $status;
            $ruangan->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('info', 'Gagal Ubah Status');
    }

    public function ubah_status_ruangan2(Request $request){
        $izin = Ruangan_Kantin::find($request->id);
        $iz = $request->aksi;
        $izin->aksi = $iz;
        $izin->save();

        return redirect()->back()->with('success', 'Berhasil Ubah Status');
    }

    public function pengajuan_pengumuman(){
        $pengumuman = DB::table('users')
        ->rightJoin('pengumuman', 'pengumuman.user_id', '=' , 'users.id')
        ->orderBy('pengumuman.created_at', 'DESC')
        ->where('level', "mahasiswa")
        ->get();

        return view('Ketertiban.Pengajuan_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function ubah_status_pengumuman_ketrtiban(Request $request){
        $ruangan = Pengumuman::find($request->id);
        if ($ruangan->status == "aktif"){
            $status = "non aktif";
            $ruangan->status = $status;
            $ruangan->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($ruangan->status == "non aktif"){
            $status = "aktif";
            $ruangan->status = $status;
            $ruangan->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('info', 'Gagal Ubah Status');
    }

    public function piket(){
        $piket = Piket::orderBy('id', 'desc')->paginate(4);

        return view('Ketertiban.Daftar_Piket', ['piket' => $piket]);
    }

    public function tambah_daftar_piket(Request $request){
        $this->validate($request, [
            'keterangan' => 'required|min:4|max:200',
            'isi' => 'required|min:50',
        ],[
            'keterangan.required' => 'Harus di isi',
            'keterangan.min' => 'Minimal 4 Digit',
            'keterangan.max' => 'Maximal 200 Digit',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
        ]);

        Piket::create([
            'user_id' => Auth::user()->id,
            'keterangan' => $request->keterangan,
            'isi' => $request->isi,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan daftar Piket');
    }

    public function hapus_piket(Request $request){
        $piket = Piket::find($request->id);
        $piket->delete();

        return redirect()->back()->with('success', 'Berhasil hapus Piket');
    }

    public function edit_piket($id){
        $piket = Piket::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $piket1 = Piket::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('Ketertiban.Edit_Piket', ['piket' => $piket, 'piket1' => $piket1]);
    }

    public function proses_edit_piket(Request $request){
        $piket = Piket::find($request->id);

        if($request->keterangan === $piket->keterangan && $request->isi === $piket->isi){
            return redirect()->back()->with('info', 'Anda tidak mengubah apapun');
        }

        $this->validate($request, [
            'keterangan' => 'required|min:4|max:200',
            'isi' => 'required|min:50',
        ],[
            'keterangan.required' => 'Harus di isi',
            'keterangan.min' => 'Minimal 4 Digit',
            'keterangan.max' => 'Maximal 200 Digit',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
        ]);

        $piket->keterangan = $request->keterangan;
        $piket->isi = $request->isi;
        $piket->save();

        return redirect()->back()->with('success', 'Berhasil Edit Pengumuman');
    }
}
