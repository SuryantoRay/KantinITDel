<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Pengumuman;
use App\Ruangan_Kantin;
use App\Alergi;
use App\Menu;
use App\Komen;
use App\Izin_tdkMakan;

class MahasiswaController extends Controller
{
    // profil
    public function halaman_profil_mahasiswa(){
        $User = User::find(Auth::user()->id);
        $pe = Pengumuman::where('user_id', Auth::user()->id)->count();

        // umur
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($User->tanggal_Lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        $User = User::where('id', Auth::user()->id)->get();

        return view('Mahasiswa.Profil_Mahasiswa', ['User' => $User, 'Umur' => $age, 'Pengumuman' => $pe]);
    }

    public function edit_profil_mahasiswa(Request $request){
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

    public function edit_gambarPr_Mahasiswa(Request $request){
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
            $tujuan_upload = 'img/Mahasiswa/Profil';
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
            $request->gambar->move(public_path().'/img/Mahasiswa/Profil', $gambar_awal);
            $User->update($pi);

            return redirect()->back()->with('success', 'Berhasil mengubah Gambar');
        }
    }

    public function buat_pengumuman_mahasiswa(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Mahasiswa.Halaman_BuPengumuman', ['Pengumuman' => $pengumuman]);
    }

    public function tambah_pengumuman_mahasiswa(Request $request){
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

        $status = "non aktif";
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

    public function semua_pengumuman_mahasiswa(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Mahasiswa.Semua_pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function edit_pengumuman_mahasiswa($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $Pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Mahasiswa.Edit_Pengumuman', ['pengumuman' => $pengumuman, 'Pengumuman' => $Pengumuman]);
    }

    public function proedit_pengumuman_mahasiswa(Request $request){
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

    public function hapus_pengumuman_mahasiswa(Request $request){
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Berhasil hapus pengumuman');
    }

    public function baca_pengumuman($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('Mahasiswa.Baca_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function halaman_ruangan(){
        $User = DB::table('users')
        ->join('ruang_kantin', 'ruang_kantin.user_id', '=' , 'users.id')
        ->orderBy('ruang_kantin.created_at', 'DESC')
        ->get();
        $Ruangan_kantin = Ruangan_kantin::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Mahasiswa.Halaman_ruang_kantin', ['User' => $User, 'Ruangan_kantin' => $Ruangan_kantin]);
    }

    public function tambah_request(Request $request){
        $this->validate($request, [
            'ruangan' => 'required',
            'tanggal_Penggunaan' => 'required',
        ],[
            'ruangan.required' => 'Harus di isi',
            'tanggal_Penggunaan.required' => 'Harus di isi',
        ]);

        Ruangan_Kantin::create([
            'user_id' => Auth::user()->id,
            'ruangan' => $request->ruangan,
            'tanggal_Penggunaan' => $request->tanggal_Penggunaan,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan request anda');
    }

    public function halaman_alergi_makanan(){
        $alergi = Alergi::where('user_id', Auth::user()->id)->get();

        return view('Mahasiswa.Keterangan_alergi', ['Alergi' => $alergi]);
    }

    public function tm_alergi(Request $request){
        $this->validate($request, [
            'alergi' => 'required|min:4',
            'gambar_ar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'alergi.required' => 'Harus di isi',
            'alergi.min' => 'Minimal 4 digit',
            'gambar_ar.required' => 'Gambar Harus Di Isi',
            'gambar_ar.file' => 'Anda Hanya Dapat Upload File',
            'gambar_ar.image' => 'Anda Hanya Dapat Upload Image',
            'gambar_ar.mimes' => 'File Harus Berupa JPG, PNG, JPEG',
            'gambar_ar.max' => 'Gambar Berukuran MAX 2MB',
        ]);

        $file = $request->file('gambar_ar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/Mahasiswa/Alergi';
        $file->move($tujuan_upload,$nama_file);

        Alergi::create([
            'alergi' => $request->alergi,
            'user_id' => Auth::user()->id,
            'gambar_ar' => $nama_file,
        ]);

        return redirect()->back()->with('success', 'Berhasil Mengirimkan Request Alergi');
    }

    public function tm_izin_tidakMakan(){
        $izin = Izin_tdkMakan::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Mahasiswa.Buat_izinTdkMakan', ['Izin' => $izin]);
    }

    public function tm_izin(Request $request){
        $this->validate($request,[
            'tanggal' => 'required',
            'alasan' => 'required|min:10|Max:200',
            'waktu' => 'required',
        ],[
            'tanggal.required' => 'Harus di isi',
            'alasan.required' => 'Harus di isi',
            'alasan.min' => 'Min 10 Digits',
            'alasan.max' => 'Max 200 Digits',
            'waktu.required' => 'Harus di isi',
        ]);

        Izin_tdkMakan::create([
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'alasan' => $request->alasan,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Membuat Izin');
    }

    public function batalkan_izin(Request $request){
        $izin = Izin_tdkMakan::find($request->id);
        $izin->delete();

        return redirect()->back()->with('success', 'Berhasil Batalkan Dan menghapus izin dari beranda anda');
    }

    public function halaman_lihat_menu(){
        $menu = Menu::orderBy('id', 'DESC')->paginate(1);
        $komen = Komen::orderBy('id', 'DESC')->paginate(6);
        return view('Mahasiswa.Halaman_lihat_menu', ['menu' => $menu , 'komen' => $komen]);
    }

    public function berikan_komentar(Request $request){
        $this->validate($request,[
            'nama' => 'required|min:4',
            'komen' => 'required|max:200',
        ],[ 
            'nama.required' => 'Harus di isi',
            'nama.min' => 'Minimal 4 digit',
            'komen.required' => 'Harus di isi',
            'komen.max' => 'Max 200 Digit',
        ]);

        Komen::create([
            'nama' => $request->nama,
            'komen' => $request->komen,
            'menu_id' => $request->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'komentar anda sudah dikirimkan.');
    }
}
