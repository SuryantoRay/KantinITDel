<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Alergi;
use App\Data_Mahasiswa;
use App\Izin_tdkMakan;
use App\Pengumuman;

class KeasramaanController extends Controller
{
    public function halaman_profil(){
        $User = User::find(Auth::user()->id);
        $pe = Pengumuman::where('user_id', Auth::user()->id)->count();

        // umur
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($User->tanggal_Lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        $User = User::where('id', Auth::user()->id)->get();

        return view('Keasramaan.Profil', ['User' => $User, 'Umur' => $age, 'Pengumuman' => $pe]);
    }

    public function edit_profil_keasramaan(Request $request){
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

    public function edit_gambar_keasrama(Request $request){
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
            $tujuan_upload = 'img/Keasramaan/Profil';
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
            $request->gambar->move(public_path().'/img/Keasramaan/Profil', $gambar_awal);
            $User->update($pi);

            return redirect()->back()->with('success', 'Berhasil mengubah Gambar');
        }
    }

    public function halaman_pengumuman_keasramaan(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Keasramaan.Pengumuman', ['Pengumuman' => $pengumuman]);
    }

    public function tambah_pengumuman_keasramaan(Request $request){
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

    public function edit_pengumuman_keasramaan($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $Pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Keasramaan.Edit_Pengumuman', ['pengumuman' => $pengumuman, 'Pengumuman' => $Pengumuman]);
    }

    public function hapus_pengumuman_keasramaan(Request $request){
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Berhasil hapus pengumuman');
    }

    public function proses_editPe_keasramaan(Request $request){
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

    public function baca_pengumuman_keasramaan($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('Keasramaan.Baca_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function semua_pengumuman_keasramaan(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Keasramaan.Semua_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function halaman_Menajemen_Mahasiswa(){
        $data = Data_Mahasiswa::orderBy('id', 'DESC')->get();

        return view('Keasramaan.Menajemen_Mahasiswa', ['Data' => $data]);
    }

    public function edit_data_mahasiswa(Request $request){
        $data = Data_Mahasiswa::find($request->id);

        if($request->laki_laki == $data->laki_laki && $request->perempuan == $data->perempuan){
            return redirect()->back()->with('info', 'Anda tidak mengubah data sedikitpun');
        }

        $this->validate($request, [
            'laki_laki' => 'required',
            'perempuan' => 'required',
        ],[
            'laki_laki.required' => 'Harus Di Isi',
            'pengumuman.required' => 'Harus Di Isi',
        ]);

        $jlm = $request->laki_laki + $request->perempuan;

        $data->jumlah_mahasiswa = $jlm;
        $data->laki_laki = $request->laki_laki;
        $data->perempuan = $request->perempuan;
        $data->save();
        return redirect()->back()->with('success','Berhasil Mengubah data');
    }

    public function izin_tdkMakan(){
        $iz = DB::table('users')
        ->rightJoin('izin_tdk_makan', 'izin_tdk_makan.user_id', '=' , 'users.id')
        ->orderBy('izin_tdk_makan.created_at', 'DESC')
        ->get();

        return view('Keasramaan.Izin_Makan', ['izin' => $iz]);
    }

    public function ubah_status_izin(Request $request){
        $izin = Izin_tdkMakan::find($request->id);
        if ($izin->status == "diterima"){
            $status = "ditolak";
            $izin->status = $status;
            $izin->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($izin->status == "ditolak"){
            $status = "diterima";
            $izin->status = $status;
            $izin->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('info', 'Gagal Ubah Status');
    }

    public function ubah_status_izin2(Request $request){
        $izin = Izin_tdkMakan::find($request->id);
        $iz = $request->status;
        $izin->status = $iz;
        $izin->save();

        return redirect()->back()->with('success', 'Berhasil Ubah Status');
    }

    public function alergi_makanan_acc(){
        $user = DB::table('users')
        ->rightJoin('alergi', 'alergi.user_id', '=' , 'users.id')
        ->select('users.name as name', 'users.kedudukan', 'users.jenis_Kelamin', 'alergi.id', 'alergi.gambar_ar', 'alergi.alergi', 'alergi.created_at', 'alergi.status')
        ->orderBy('alergi.created_at', 'DESC')
        ->get();

        return view("Keasramaan.Alergi_Makanan", ["user" => $user]);
    }

    public function ubah_status_alergi(Request $request){
        $izin = Alergi::find($request->id);
        if ($izin->status == "diterima"){
            $status = "ditolak";
            $izin->status = $status;
            $izin->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($izin->status == "ditolak"){
            $status = "diterima";
            $izin->status = $status;
            $izin->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('info', 'Gagal Ubah Status');
    }

    public function ubah_status_alergi2(Request $request) {
        $izin = Alergi::find($request->id);
        $iz = $request->status;
        $izin->status = $iz;
        $izin->save();

        return redirect()->back()->with('success', 'Berhasil Ubah Status');
    }
}
