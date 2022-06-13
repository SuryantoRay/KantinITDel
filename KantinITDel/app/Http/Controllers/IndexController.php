<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pengumuman;
use App\User;
use App\Menu;
use App\Data_Mahasiswa;
use App\Piket;
use App\Informasi;
use DateTime;

class IndexController extends Controller
{
    public function index(){
        if (Auth::user()->level == "mahasiswa"){
            $informasi = Informasi::where('status', 'aktif')->orderBy('id', 'DESC')->paginate(6);
            $pengumuman = Pengumuman::where('kepada', '=', 'Mahasiswa')->where('status', 'aktif')->orderBy('id', 'DESC')->paginate(8);
            $piket = Piket::orderBy('created_at', 'DESC')->paginate(1);

            return view('Dashboard', ['Informasi' => $informasi, 'Pengumuman' => $pengumuman, 'piket' => $piket]);
        }elseif (Auth::user()->level == "keasramaan"){
            $informasi = Informasi::where('status', 'aktif')->orderBy('id', 'DESC')->paginate(6);
            $pengumuman = Pengumuman::where('kepada', '=', 'Keasramaan')->where('status', 'aktif')->orderBy('id', 'DESC')->paginate(8);

            return view('Dashboard', ['Informasi' => $informasi, 'Pengumuman' => $pengumuman]);
        }elseif (Auth::user()->level == "ketertiban"){
            $informasi = Informasi::where('status', 'aktif')->orderBy('id', 'DESC')->paginate(6);
            $pengumuman = Pengumuman::where('kepada', '=', 'Mahasiswa')->where('status', 'aktif')->orderBy('id', 'DESC')->paginate(8);

            return view('Dashboard', ['Informasi' => $informasi, 'Pengumuman' => $pengumuman]);
        }elseif (Auth::user()->level == "admin"){
            $data = Data_Mahasiswa::all();
            $data1 = Pengumuman::count();
            $data2 = Informasi::count();
            $data3 = User::count();
            $pengumuman = Pengumuman::where('status', 'aktif')->orderBy('id', 'DESC')->paginate(8);
            $menu = Menu::orderBy('id', 'DESC')->paginate(1);

            return view('Dashboard', ['Data' => $data, 'Data1' => $data1, 'Data2' => $data2, 'Data3' => $data3, 'Pengumuman' => $pengumuman, 'menu' => $menu]);
        }
        return view('Dashboard');
    }

    public function daftar($id){
        return view('Register.Fm_Register', ['id' => $id]);
    }

    public function register(Request $request){
        return view('Register.Register');
    }

    public function baca_pengumuman($id){
        $pengumuman = Pengumuman::where('id', $id)->where('status', 'aktif')->get();

        return view('All.Baca_Pengumuman', ['pengumuman' => $pengumuman]);
    }

    public function baca_berita($id){
        $informasi = Informasi::where('id', $id)->where('status', 'aktif')->get();

        return view('All.Baca_Informasi', ['Informasi' => $informasi]);
    }

    public function baca_piket($id){
        $piket = Piket::where('id', $id)->get();

        return view('All.Baca_Piket', ['piket' => $piket]);
    }
}
