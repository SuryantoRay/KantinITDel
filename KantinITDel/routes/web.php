<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/daftar/{id}', 'IndexController@daftar')->name('daftar');

Route::group(['middleware' => ['auth', 'ceklevel:admin,keasramaan,mahasiswa,ketertiban']], function () {
    Route::get('/dashboard', 'IndexController@index');
    Route::get('/baca_pengumuman/{id}', 'IndexController@baca_pengumuman')->name('bc.pe_sm');
    Route::get('/baca_informasi/{id}', 'IndexController@baca_berita')->name('bc.if_sm');
    Route::get('/baca_piket/{id}', 'IndexController@baca_piket')->name('bc.pkt');
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function() {
    // Kategori
    Route::get('/tambah_kategori', 'AdminController@tambah_kategori')->name('tm.kategori');
    Route::post('/tmK_proses', 'AdminController@tm_kategori')->name('proses_tmK');
    Route::post('/edit_kategori', 'AdminController@edit_kategori')->name('ed.kategori');
    Route::post('/hapus_kategori', 'AdminController@hapus_kategori')->name('h.kategori');
    // Informasi
    Route::get('/halaman_tambah_informasi', 'AdminController@halaman_tambah_informasi')->name('h.informasi');
    Route::get('/lihat_informasi', 'AdminController@lihat_informasi')->name('l.informasi');
    Route::post('/tambah_informasi', 'AdminController@tambah_informasi')->name('tm.informasi');
    Route::post('/hapus_informasi', 'AdminController@hapus_informasi')->name('hp.informasi');
    Route::get('/edit_informasi/{id}', 'AdminController@edit_informasi')->name('ed.informasi');
    Route::post('/edit_profil_informasi', 'AdminController@edit_profil_informasi')->name('ed.p_informasi');
    Route::post('/edit_gambar_informasi', 'AdminController@edit_gambar_informasi')->name('ed.g_informasi');
    Route::get('/edit_status_informasi_admin/{id}', 'AdminController@edit_status_informasi_admin')->name('ed.st_if_admin');
    Route::get('/semua_informasi_anda', 'AdminController@semua_informasi_anda')->name('sm.informasi_anda');
    Route::get('/baca_informasi_admin', 'AdminController@baca_informasi_admin')->name('bc.if_admin');
    // profil
    Route::get('/profil_admin', 'AdminController@profil_admin')->name('profil.admin');
    Route::post('/edit_profil_admin', 'AdminController@edit_profil_admin')->name('ed.p_admin');
    Route::post('/edit_profil_gambar', 'AdminController@edit_profil_gambar')->name('ed.g_admin');
    // Pengumuman
    Route::get('/halaman_crud_pengumuman', 'AdminController@halaman_crud_pengumuman')->name('h.crud_pengumuman');
    Route::post('/buat_pengumuman_admin', 'AdminController@buat_pengumuman_admin')->name('tm.pe_admin');
    Route::post('/hapus_pengumuman_admin', 'AdminController@hapus_pengumuman_admin')->name('hp_pe_admin');
    Route::get('/baca_Pengumuman_admin/{id}', 'AdminController@baca_Pengumuman')->name('bc_pe');
    Route::get('/semua_pengumuman_admin', 'AdminController@semua_pengumuman_anda')->name('sm.pe_admin');
    Route::get('/edit_pengumuman_admin/{id}', 'AdminController@edit_pengumuman_admin')->name('ed.pe_admin');
    Route::post('/edit_pro_pengumuman_admin', 'AdminController@edit_pro_pengumuman_admin')->name('ed.pro_pe_admin');
    Route::get('/edit_status_pengumuman_admin/{id}', 'AdminController@edit_status_pengumuman_admin')->name('ed.st_pe_admin');
    Route::get('/tambah_admin', 'AdminController@tambah_admin')->name('tm.Admin');
    Route::post('/proses_tambah_admin', 'AdminController@proses_tambah_admin')->name('tm.pro_Admin');
    // detail makanan
    Route::get('/detail_makanan', 'AdminController@detail_makanan')->name('dt.mk');
    // menu makanan
    Route::get('/tm_menu_makanan', 'AdminController@tm_menu_makanan')->name('tm_mnMk');
    Route::post('/tm_menuMakanan', 'AdminController@tm_menuMakanan')->name('tm_MK');
    Route::post('/hapus_menu', 'AdminController@hapus_menu')->name('ha_MN');
    Route::get('/halaman_edit_menu/{id}', 'AdminController@halaman_edit_menu')->name('hal.ed_menu');
    Route::post('/proses_edit_menu', 'AdminController@proses_edit_menu')->name('pro.ed_menu');
    // komentar
    Route::get('/halaman_komentar/{id}', 'AdminController@halaman_komentar')->name('hal.kom');
    Route::post('/hapus_komentar', 'AdminController@hapus_komentar')->name('hapus.kom');
    Route::post('/edit_status_komentar', 'AdminController@edit_status_komentar')->name('edit.status_kom');
    // daftar user
    Route::get('/daftar_user', 'AdminController@daftar_user')->name('df.us');
});

Route::group(['middleware' => ['auth', 'ceklevel:mahasiswa']], function() {
    // profil
    Route::get('/halaman_profil_mahasiswa', 'MahasiswaController@halaman_profil_mahasiswa')->name('ha.pr_mahaiswa');
    Route::post('/edit_profil_mahasiswa', 'MahasiswaController@edit_profil_mahasiswa')->name('ed.pro_mahasiswa');
    Route::post('/edit_gambarPr_Mahasiswa', 'MahasiswaController@edit_gambarPr_Mahasiswa')->name('ed.Gpro_mahasiswa');
    // membuat Pengumuman
    Route::get('/buat_pengumuman_mahasiswa', 'MahasiswaController@buat_pengumuman_mahasiswa')->name('ha_pe_mahasiswa');
    Route::post('/tambah_pengumuman_mahasiswa', 'MahasiswaController@tambah_pengumuman_mahasiswa')->name('tm.pe_mahasiswa');
    Route::get('/semua_pengumuman_mahasiswa', 'MahasiswaController@semua_pengumuman_mahasiswa')->name('sm.pe_mahasiswa');
    Route::get('/edit_pengumuman_mahasiswa/{id}', 'MahasiswaController@edit_pengumuman_mahasiswa')->name('ed.pe_mahasiswa');
    Route::post('/proses_editPe_mahasiswa', 'MahasiswaController@proedit_pengumuman_mahasiswa')->name('pro.edPe_mahasiswa');
    Route::post('/hapus_pengumuman_mahasiswa', 'MahasiswaController@hapus_pengumuman_mahasiswa')->name('h.pe_mahasiswa');
    Route::get('/baca_pengumuman_Mahasiswa/{id}', 'MahasiswaController@baca_pengumuman')->name('bc.pe_m');
    // Ruangan Kantin
    Route::get('/halaman_ruangan_kantin', 'MahasiswaController@halaman_ruangan')->name('ha.kantin');
    Route::post('/tambah_request', 'MahasiswaController@tambah_request')->name('tm_request');
    // Alergi Makanan
    Route::get('/halaman_alergi_makanan', 'MahasiswaController@halaman_alergi_makanan')->name('ha.alergi_makanan');
    Route::post('/tm_alergi', 'MahasiswaController@tm_alergi')->name('tm_alergi');
    // Tidak Makanan
    Route::get('/tm_izin_tidakMakan', 'MahasiswaController@tm_izin_tidakMakan')->name('tm_iz_mk');
    Route::post('/pro_tm_izin', 'MahasiswaController@tm_izin')->name('tm_izin');
    Route::post('/batalkan_izin', 'MahasiswaController@batalkan_izin')->name('bt_izin');
    // Lihat Menu
    Route::get('/halaman_lihat_menu', 'MahasiswaController@halaman_lihat_menu')->name('li.ha_me');
    Route::post('/berikan_komentar', 'MahasiswaController@berikan_komentar')->name('br.komen');
});

Route::group(['middleware' => ['auth', 'ceklevel:ketertiban']], function() {
    // profil
    Route::get('profil_ketertiban', 'KetertibanController@profil_ketertiban')->name('pr.ktr');
    Route::post('/edit_profil_ketertiban', 'KetertibanController@edit_profil_ketertiban')->name('ed.pr_ktr');
    Route::post('/edit_gambar_ketertiban', 'KetertibanController@edit_gambar_ketertiban')->name('ed.gm_ktr');
    // Membuat pengumuman
    Route::get('/pengumuman_ketertiban', 'KetertibanController@pengumuman_ketertiban')->name('h.pe_ktr');
    Route::get('/baca_pengumuman_ketertiban/{id}', 'KetertibanController@baca_pengumuman_ketertiban')->name('bc.pe_ktr');
    Route::get('/semua_pengumuman_ketertiban', 'KetertibanController@semua_pengumuman_ketertiban')->name("sm.pe_ktr");
    Route::get('/edit_pengumuman_ketertiban/{id}', 'KetertibanController@edit_pengumuman_ketertiban')->name('ed.pe_ktr');
    Route::post('/buat_pengumuman_ketertiban', 'KetertibanController@buat_pengumuman_ketertiban')->name('tm.pe_ktr');
    Route::post('/proEdit_pengumuman_ketertiban', 'KetertibanController@proEdit_pengumuman_ketertiban')->name('pro.ed_pe_ktr');
    Route::post('/hapus_pengumuman_ketertiban', 'KetertibanController@hapus_pengumuman_ketertiban')->name('hp.pe_ktr');
    // Pengajuan ruangan kantin
    Route::get('/pengajuan_ruangan_kantin', 'KetertibanController@pengajuan_Ruangan_kantin')->name('h.peRu_ktn');
    Route::post('/ubah_status_ruangan1', 'KetertibanController@ubah_status_ruangan1')->name('ub.ruangan1');
    Route::post('/ubah_status_ruangan2', 'KetertibanController@ubah_status_ruangan2')->name('ub.ruangan2');
    // Pengajuan pengumuman
    Route::get('/pengajuan_pengumuman', 'KetertibanController@pengajuan_pengumuman')->name('h.pePe_ktr');
    Route::post('/ubah_status_pengumuman_ketertiban', 'KetertibanController@ubah_status_pengumuman_ketrtiban')->name('ub.pe_ktr');
    // piket
    Route::get('/piket', 'KetertibanController@piket')->name('piket');
    Route::post('/tambah_daftar_piket', 'KetertibanController@tambah_daftar_piket')->name('tm.df_pk');
    Route::get('/piket_edit/{id}', 'KetertibanController@edit_piket')->name('ed.pkt_ktr');
    Route::post('/proses_edit_piket', 'KetertibanController@proses_edit_piket')->name('pro.ed_pkt');
    Route::post('/hapus_piket', 'KetertibanController@hapus_piket')->name('hp.pkt');
});

Route::group(['middleware' => ['auth', 'ceklevel:keasramaan']], function() {
    // profil
    Route::get('/halaman_profil_Keasramaan', 'KeasramaanController@halaman_profil')->name('h.pro_asrama');
    Route::post('/edit_profil_keasramaan', 'KeasramaanController@edit_profil_keasramaan')->name('ed.pro_asrama');
    Route::post('/edit_gambar_keasramaan', 'KeasramaanController@edit_gambar_keasrama')->name('ed.gambar_pro_asrama');
    // Membuat pengumuman
    Route::get('/halaman_pengumuman_keasramaan', 'KeasramaanController@halaman_pengumuman_keasramaan')->name('h.pe_asrama');
    Route::get('/semua_pengumuman_keasramaan', 'KeasramaanController@semua_pengumuman_keasramaan')->name('sm.pe_asrama');
    Route::get('/edit_pengumuman_keasramaan/{id}', 'KeasramaanController@edit_pengumuman_keasramaan')->name('ed.pe_asrama');
    Route::get('/baca_pengumuman_keasramaan/{id}', 'KeasramaanController@baca_pengumuman_keasramaan')->name('bc.pe_asrama');
    Route::post('/tambah_pengumuman_keasramaan', 'KeasramaanController@tambah_pengumuman_keasramaan')->name('tm.pe_asrama');
    Route::post('/proses_editPe_keasramaan', 'KeasramaanController@proses_editPe_keasramaan')->name('pr.ed_pe_asrama');
    Route::post('/hapus_pengumuman_keasramaan', 'KeasramaanController@hapus_pengumuman_keasramaan')->name('ha.pe_asrama');
    // Menajemen mahasiswa
    Route::get('/halaman_Menajemen_Mahasiswa', 'KeasramaanController@halaman_Menajemen_Mahasiswa')->name('h.mnj_mh');
    Route::post('/edit_data_mahasiswa', 'KeasramaanController@edit_data_mahasiswa')->name('ed.dt_mh');
    // izin makana
    Route::get('/izin_tdkMakan', 'KeasramaanController@izin_tdkMakan')->name('iz.tdMK');
    Route::post('/ubah_status_izin', 'KeasramaanController@ubah_status_izin')->name('ub.st_iz');
    Route::post('/ubah_status_izin2', 'KeasramaanController@ubah_status_izin2')->name('ub.st_iz2');
    // alergi_makanan
    Route::get('/alergi_makanan_acc', 'KeasramaanController@alergi_makanan_acc')->name('h.al_mkAcc');
    Route::post('/ubah_status_alergi', 'KeasramaanController@ubah_status_alergi')->name('ub.st_al');
    Route::post('/ubah_status_alergi2', 'KeasramaanController@ubah_status_alergi2')->name('ub.st_al2');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
