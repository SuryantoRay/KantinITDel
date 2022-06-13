<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Kategori;
use App\User;
use App\Pengumuman;
use App\Informasi;
use App\Data_Mahasiswa;
use App\Menu;
use App\Komen;
use Carbon\Carbon;
use Dotenv\Result\Success;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Kategori
    public function tambah_kategori(){
        $User = User::where('id', Auth::user()->id)->get();
        $kategori = User::All();

        return view('Admin.tm_kategori', ['User' => $User, 'Kategori' => $kategori]);
    }

    public function tm_kategori(Request $request){
        $this->validate($request, [
            'kode' => 'required|min:4|max:12|unique:kategori',
            'kategori' => 'required|min:5|max:24',
        ],[
            'kode.required' => 'Harus di isi',
            'kode.min' => 'Minimal 4 Digit',
            'kode.max' => 'Maxsimal 12 Digit',
            'kode.unique' => 'Kode yang ini mungkin sudah digunakan',
            'kategori.required' => 'Harus di isi',
            'kategori.min' => 'Minimal 4 Digit',
            'kategori.max' => 'Maximal 24 Digit',
        ]);

        Kategori::Create([
            'kode' => $request->kode,
            'kategori' => $request->kategori,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Kategori Berhasil Di Tambahkan.');
    }

    public function edit_kategori(Request $request){
        $kategori = Kategori::find($request->id);

        if ($kategori->kategori === $request->kategori_ed){
            return redirect()->back()->with('info', 'Anda tidak mengubah data sedikit pun !');
        }

        $this->validate($request, [
            'kategori_ed' => 'required|min:4|max:24',
        ],[
            'kategori_ed.required' => 'Kategori Harus diisi',
            'kategori_ed.min' => 'Kategori Minimal 4 Digit',
            'kategori_ed.max' => 'Kategori Maximal 24 Digit',
        ]);

        $kategori = Kategori::find($request->id);
        $kategori->kategori = $request->kategori_ed;
        $kategori->save();

        return redirect()->back()->with('success', 'Kategori Berhasil Ubah');
    }

    public function hapus_kategori(Request $request){
        $kategori = Kategori::find($request->id);
        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori Berhasil Di Hapus');
    }

    // Informasi
    public function halaman_tambah_informasi(){
        $kategori = Kategori::All();
        $Informasi = Informasi::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Admin.tm_Informasi', ['Kategori' => $kategori, 'Informasi' => $Informasi]);
    }

    public function tambah_informasi(Request $request){
        // dd($request->all());
        $this->validate($request, [
            'judul' => 'required|min:4|max:200',
            'kategori' => 'required',
            'gambar_if' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'isi' => 'required|min:50',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 4 Digit',
            'judul.max' => 'Maximal 200 Digit',
            'kategori.required' => 'Harus di isi',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
            'gambar_if.required' => 'Harus Di Isi',
            'gambar_if.file' => 'Anda Hanya Dapat Upload File',
            'gambar_if.image' => 'Anda Hanya Dapat Upload Image',
            'gambar_if.mimes' => 'Harus Berupa JPG, PNG, JPEG',
            'gambar_if.max' => 'Berukuran MAX 2MB',
        ]);

        $file = $request->file('gambar_if');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'img/Admin/Informasi';
        $file->move($tujuan_upload,$nama_file);

        $status = "aktif";

        Informasi::create([
            'user_id' => Auth::user()->id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'gambar_if' => $nama_file,
            'status' => $status,
            'isi' => $request->isi,
        ]);

        return redirect(route('l.informasi'))->with('success', 'Informasi Berhasil Di Tambahkan');
    }

    public function lihat_informasi(){
        $User = DB::table('users')
        ->rightJoin('informasi', 'informasi.user_id', '=' , 'users.id')
        ->orderBy('informasi.created_at', 'DESC')
        ->get();

        return view('Admin.Lihat_Informasi', ['User' => $User]);
    }

    public function hapus_informasi(Request $request){
        $informasi = Informasi::find($request->id);
        $informasi->delete();
        return redirect()->back()->with('success', 'Informasi Berhasil Di Hapus');
    }

    public function edit_informasi($id){
        $informasi = Informasi::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $kategori = Kategori::All();

        return view('Admin.ed_informasi', ['Informasi' => $informasi, 'Kategori' => $kategori]);
    }

    public function edit_profil_informasi(Request $request){
        $informasi = Informasi::find($request->id);

        if($informasi->judul === $request->judul && $informasi->isi === $request->isi && $informasi->kategori === $request->kategori){
            return redirect()->back()->with('info', 'Anda tidak mengubah data sedikit pun !');
        }

        $this->validate($request, [
            'judul' => 'required|min:4|max:200',
            'kategori' => 'required',
            'isi' => 'required|min:50',
        ],[
            'judul.required' => 'Harus di isi',
            'judul.min' => 'Minimal 4 Digit',
            'judul.max' => 'Maximal 200 Digit',
            'kategori.required' => 'Harus di isi',
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Minimal 50',
        ]);

        $informasi->judul = $request->judul;
        $informasi->isi = $request->isi;
        $informasi->kategori = $request->kategori;
        $informasi->save();

        return redirect()->back()->with('success', 'Berhasil Update Informasi');
    }

    public function edit_gambar_informasi(Request $request){
        $gambar = Informasi::find($request->id);

        if($request->gambar_if == null){
            return redirect()->back()->with('info', 'Tidak Ada Gambar');
        }

        $this->validate($request, [
            'gambar_if' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'gambar_if.required' => 'Harus Di Isi',
            'gambar_if.file' => 'Anda Hanya Dapat Upload File',
            'gambar_if.image' => 'Anda Hanya Dapat Upload Image',
            'gambar_if.mimes' => 'Harus Berupa JPG, PNG, JPEG',
            'gambar_if.max' => 'Berukuran MAX 2MB',
        ]);

        $gambar_awal = $gambar->gambar_if;
        $pi = [
            'gambar_if' => $gambar_awal,
        ];
        $request->gambar_if->move(public_path().'/img/Admin/Informasi', $gambar_awal);
        $gambar->update($pi);

        return redirect()->back()->with('success', 'Berhasil memperbaharui gambar dari informasi !');
    }

    public function edit_status_informasi_admin($id){
        $penge = Informasi::find($id);
        if ($penge->status == "aktif"){
            $status = "non aktif";
            $penge->status = $status;
            $penge->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($penge->status == "non aktif"){
            $status = "aktif";
            $penge->status = $status;
            $penge->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('success', 'Gagal Ubah Status');
    }

    public function semua_informasi_anda(){
        $informasi = Informasi::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Admin.sm_Informasi', ['Informasi' => $informasi]);
    }

    public function profil_admin(){
        $User = User::find(Auth::user()->id);
        $post = Informasi::where('user_id', Auth::user()->id)->count();
        $pe = Pengumuman::where('user_id', Auth::user()->id)->count();

        // umur
        $now = Carbon::now(); // Tanggal sekarang
        $b_day = Carbon::parse($User->tanggal_Lahir); // Tanggal Lahir
        $age = $b_day->diffInYears($now);  // Menghitung umur

        $User = User::where('id', Auth::user()->id)->get();

        return view('Admin.Profil', ['User' => $User, 'Post' => $post, 'Umur' => $age, 'Pengumuman' => $pe]);
    }

    public function edit_profil_admin(Request $request){
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

    public function edit_profil_gambar(Request $request){
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
            $tujuan_upload = 'img/Admin/Profil';
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
            $request->gambar->move(public_path().'/img/Admin/Profil', $gambar_awal);
            $User->update($pi);

            return redirect()->back()->with('success', 'Berhasil mengubah Gambar');
        }
    }

    public function halaman_crud_pengumuman(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Admin.tm_Pengumuman', ['Pengumuman' => $pengumuman]);
    }

    public function buat_pengumuman_admin(Request $request){
        // dd($request->all());
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

        Pengumuman::create([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $status,
            'kepada' => $request->kepada,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Pengumuman');
    }

    public function hapus_pengumuman_admin(Request $request){
        $pengumuman = Pengumuman::find($request->id);
        $pengumuman->delete();

        return redirect()->back()->with('success', 'Berhasil hapus pengumuman');
    }

    public function baca_Pengumuman($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('Admin.Baca_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function semua_pengumuman_anda(){
        $pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('Admin.sm_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function edit_pengumuman_admin($id){
        $pengumuman = Pengumuman::where('id', $id)->where('user_id', Auth::user()->id)->get();
        $Pengumuman = Pengumuman::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(4);

        return view('Admin.Edit_Pengumuman', ['pengumuman' => $pengumuman, 'Pengumuman' => $Pengumuman]);
    }

    public function edit_pro_pengumuman_admin(Request $request){
        $pengumuman = Pengumuman::find($request->id);

        if($request->judul === $pengumuman->judul && $request->isi === $pengumuman->isi && $request->kepada === $pengumuman->kepada){
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
        $pengumuman->kepada = $request->kepada;
        $pengumuman->save();

        return redirect()->back()->with('success', 'Berhasil Edit Pengumuman');
    }

    public function edit_status_pengumuman_admin($id){
        $penge = Pengumuman::find($id);
        if ($penge->status == "aktif"){
            $status = "non aktif";
            $penge->status = $status;
            $penge->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($penge->status == "non aktif"){
            $status = "aktif";
            $penge->status = $status;
            $penge->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('success', 'Gagal Ubah Status');
    }

    public function tambah_admin(){
        return view('Admin.tm_Admin');
    }

    public function proses_tambah_admin(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required',
            'kedudukan' => 'required',
            'tanggal_Lahir' => 'required',
            'jenis_Kelamin' => 'required',
            'tingkat' => 'required',
            'alamat' => 'required',
        ],[
            'name.required' => 'Harus Di Isi',
            'name.string' => 'Harus Berupa String',
            'name.max' => 'Max 255 masukan',
            'name.min' => 'Minimal 8 masukan',
            'email.required' => 'Harus Di Isi',
            'email.string' => 'Harus Berupa String',
            'email.max' => 'Max 255 masukan',
            'email.unique' => 'Email ini sudah ada yang menggunakan',
            'password.required' => 'Harus Di Isi',
            'password.string' => 'Harus Berupa String',
            'password.min' => 'Minimal 8 masukan',
            'kedudukan.required' => 'Harus Di Isi',
            'tanggal_Lahir.required' => 'Harus Di Isi',
            'jenis_Kelamin.required' => 'Harus Di Isi',
            'tingkat.required' => 'Harus Di Isi',
            'alamat.required' => 'Harus Di Isi',
        ]);

        User::create([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tanggal_Lahir' => $request->tanggal_Lahir,
            'jenis_Kelamin' => $request->jenis_Kelamin,
            'alamat' => $request->alamat,
            'kedudukan' => $request->kedudukan,
            'tingkat' => $request->tingkat,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Admin');
    }

    public function tm_menu_makanan(){
        $menu = DB::table('users')
        ->rightJoin('menu', 'menu.user_id', '=' , 'users.id')
        ->select('menu.id as menu_id', 'menu.user_id as user_id' ,'menu.isi', 'menu.created_at', 'users.name')
        ->orderBy('menu.created_at', 'DESC')
        ->get();

        return view('Admin.tm_MenuMakanan', ['menu' => $menu]);
    }

    public function tm_menuMakanan(Request $request){
        $this->validate($request,[
            'isi' => 'required|min:40',
        ],[
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Min 40 Digit',
        ]);

        Menu::create([
            'isi' => $request->isi,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Menu Makanan Hari ini');
    }

    public function hapus_menu(Request $request){
        $menu = Menu::find($request->id);
        $menu->delete();

        return redirect()->back()->with('success', 'Berhasil Hapus Menu');
    }

    public function halaman_edit_menu($id){
        $menu = Menu::where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('Admin.ed_Menu', ['menu' => $menu]);
    }

    public function proses_edit_menu(Request $request){
        $menu = Menu::find($request->id);

        if ($menu->isi === $request->isi){
            return redirect()->back()->with('info', 'Anda tidak mengubah data sedikit pun !');
        }

        $this->validate($request, [
            'isi' => 'required|min:40',
        ],[
            'isi.required' => 'Harus Di Isi',
            'isi.min' => 'Min 40 Digit',
        ]);

        $menu->isi = $request->isi;
        $menu->save();

        return redirect()->back()->with('success', 'Menu Berhasil Ubah');
    }

    public function halaman_komentar($id){
        $komen = Komen::where('menu_id', $id)->orderBy('id', 'DESC')->get();

        return view('Admin.Kelolah_komentar', ['komen' => $komen]);
    }

    public function hapus_komentar(Request $request){
        $komen = Komen::find($request->id);
        $komen->delete();

        return redirect()->back()->with('success', 'Berhasil Hapus Komen');
    }

    public function edit_status_komentar(Request $request){
        $komen = Komen::find($request->id);
        if ($komen->status == "aktif"){
            $status = "non aktif";
            $komen->status = $status;
            $komen->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        } else if ($komen->status == "non aktif"){
            $status = "aktif";
            $komen->status = $status;
            $komen->save();
            return redirect()->back()->with('success', 'Berhasil Ubah Status');
        }

        return redirect()->back()->back()->with('success', 'Gagal Ubah Status');
    }

    public function daftar_user(){
        $mahasiswa = User::where('level', 'mahasiswa')->orderBy('id', 'DESC')->get();
        $ketertiban = User::where('level', 'ketertiban')->orderBy('id', 'DESC')->get();
        $keasramaan = User::where('level', 'keasramaan')->orderBy('id', 'DESC')->get();

        return view('Admin.Daftar_Users', ['mahasiswa' => $mahasiswa, 'ketertiban' => $ketertiban , 'keasramaan' => $keasramaan]);
    }

    public function detail_makanan(){
        $time = date('Y-m-d');
        $data_mahasiswa = Data_Mahasiswa::get();
        $user = DB::table('users')
        ->rightJoin('alergi', 'alergi.user_id', '=' , 'users.id')
        ->where('alergi.status', 'diterima')
        ->orderBy('alergi.created_at', 'DESC')
        ->get();
        $user1 = DB::table('users')
        ->rightJoin('izin_tdk_makan', 'izin_tdk_makan.user_id', '=' , 'users.id')
        ->where('status', 'diterima')
        ->where('izin_tdk_makan.tanggal', $time)
        ->orderBy('izin_tdk_makan.created_at', 'DESC')
        ->get();

        return view('Admin.Detail_Sarapan', ['data_mahasiswa' => $data_mahasiswa, 'user' => $user, 'user1' => $user1]);
    }
}
