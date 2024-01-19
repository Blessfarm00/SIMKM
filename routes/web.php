<?php

use App\Http\Middleware\MustAdmin;
use App\Http\Middleware\PreventBackAfterLogin;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::post('/login-proses', 'App\Http\Controllers\Auth\LoginController@authenticate');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::get('/register', 'App\Http\Controllers\Auth\LoginController@registrasi');
Route::post('/simpanRegistrasi', 'App\Http\Controllers\Auth\LoginController@simpanRegistrasi');

Route::get('/dashboard-pasien', 'App\Http\Controllers\PasienDashboardController@index')->name('dashboard-pasien');





Route::get('/halaman-awal', function () {
    return view('welcome');
});

// Route::get('/queue', 'App\Http\Controllers\QueueController@showQueueNumber');
// Route::get('/queue/reset', 'App\Http\Controllers\QueueController@resetQueueNumber');

Route::get('/antrian', [App\Http\Controllers\AntrianController::class, 'index'])->name('antrian.index');
Route::post('/ambil-antrian', [App\Http\Controllers\AntrianController::class, 'ambilAntrian'])->name('ambil-antrian');
Route::post('/reset-otomatis', [App\Http\Controllers\AntrianController::class, 'resetOtomatis'])->name('reset-otomatis');
Route::post('/cetak', [App\Http\Controllers\AntrianController::class, 'cetak'])->name('cetak');
Route::get('/index', 'App\Http\Controllers\AntrianController@show');



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['cekLogin'])->group(
    function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
 Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');


                Route::middleware(['role:superadmin'])->group(
                    function () {
                        Route::get('/user', 'App\Http\Controllers\UserController@index');
                        Route::get('/user/create', 'App\Http\Controllers\UserController@create');
                        Route::post('/user', 'App\Http\Controllers\UserController@store');
                        Route::get('/user/{user}', 'App\Http\Controllers\UserController@show');
                        Route::get('/user/{user}/edit', 'App\Http\Controllers\UserController@edit');
                        Route::put('/user/{id}', 'App\Http\Controllers\UserController@update');
                        Route::delete('/user/{user}', 'App\Http\Controllers\UserController@destroy');
                    }
                );

        
        Route::middleware(['blockdokter'])->group(function () {
                Route::middleware(['blocksuper'])->group(function () {
                        Route::get('/obat/create', 'App\Http\Controllers\ObatController@create');
                        Route::post('/obat', 'App\Http\Controllers\ObatController@store');
                        Route::get('/obat/{obat}', 'App\Http\Controllers\ObatController@show');
                        Route::get('/obat/{obat}/edit', 'App\Http\Controllers\ObatController@edit');
                        Route::put('/obat/{obat}', 'App\Http\Controllers\ObatController@update');
                        Route::delete('/obat/{obat}', 'App\Http\Controllers\ObatController@destroy');
                       
                });
                        Route::get('/obat', 'App\Http\Controllers\ObatController@index');
        });

        Route::middleware(['blockdokter'])->group(function () {
                Route::middleware(['blocksuper'])->group(function () {
                        Route::get('/pasien/create', 'App\Http\Controllers\PasienController@create');
                        Route::post('/pasien', 'App\Http\Controllers\PasienController@store');
                        Route::get('/pasien/{pasien}', 'App\Http\Controllers\PasienController@show');
                        Route::get('/pasien/{pasien}/edit', 'App\Http\Controllers\PasienController@edit');
                        Route::put('/pasien/{pasien}', 'App\Http\Controllers\PasienController@update');
                        Route::delete('/pasien/{pasien}', 'App\Http\Controllers\PasienController@destroy');
                });
        });
        Route::get('/pasien', 'App\Http\Controllers\PasienController@index');


                Route::group(['middleware' => 'blocksuper'], function () {

                        Route::group(['middleware' => 'checkdokter'], function () {
                                // Definisi rute yang hanya bisa diakses oleh dokter
                        
                Route::get('/pemeriksaan/create', 'App\Http\Controllers\PemeriksaanController@create');
                Route::post('/pemeriksaan', 'App\Http\Controllers\PemeriksaanController@store');
                Route::get('/pemeriksaan/{pemeriksaan}', 'App\Http\Controllers\PemeriksaanController@show');
                Route::get('/pemeriksaan/{pemeriksaan}/edit', 'App\Http\Controllers\PemeriksaanController@edit');
                Route::put('/pemeriksaan/{pemeriksaan}', 'App\Http\Controllers\PemeriksaanController@update');
                Route::delete('/pemeriksaan/{pemeriksaan}', 'App\Http\Controllers\PemeriksaanController@destroy');
                Route::get('/pemeriksaan/cetak', 'PemeriksaanController@cetak');
                        });
                });
        Route::get('/pemeriksaan', 'App\Http\Controllers\PemeriksaanController@index');


        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {
                
                        Route::get('/dokter/create', 'App\Http\Controllers\DokterController@create');
                        Route::post('/dokter', 'App\Http\Controllers\DokterController@store');
                        Route::get('/dokter/cetak', 'App\Http\Controllers\DokterController@cetak');
                        Route::get('/dokter/{dokter}', 'App\Http\Controllers\DokterController@show');
                        Route::get('/dokter/{dokter}/edit', 'App\Http\Controllers\DokterController@edit');
                        Route::put('/dokter/{dokter}', 'App\Http\Controllers\DokterController@update');
                        Route::delete('/dokter/{dokter}', 'App\Http\Controllers\DokterController@destroy');
                });
                        Route::get('/dokter', 'App\Http\Controllers\DokterController@index');

        });


        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {

                        Route::get('/resep-obat/create', 'App\Http\Controllers\ResepObatController@create');
                        Route::post('/resep-obat', 'App\Http\Controllers\ResepObatController@store');
                        Route::get('/resep-obat/{resep-obat}', 'App\Http\Controllers\ResepObatController@show');
                        Route::get('/resep-obat/{resep_id}/edit', [App\Http\Controllers\ResepObatController::class, 'edit'])->name('resep_obat.edit');
                        Route::put('/resep_obat/{resep_obat}', 'App\Http\Controllers\ResepObatController@update');
                        Route::delete('/resep-obat/{resep_obat}', 'App\Http\Controllers\ResepObatController@destroy');
                });
        });
        Route::get('/resep-obat', 'App\Http\Controllers\ResepObatController@index');


        Route::group(['middleware' => 'checkdokter'], function () {
                Route::group(['middleware' => 'blocksuper'], function () {
                        Route::get('/rekam-medis/create', 'App\Http\Controllers\RekamMedisController@create');
                        Route::post('/rekam-medis', 'App\Http\Controllers\RekamMedisController@store');
                        Route::get('/rekam-medis/{rekam-medis}', 'App\Http\Controllers\RekamMedisController@show');
                        Route::get('/rekam_medis/{rekam_medis}/edit', 'App\Http\Controllers\RekamMedisController@edit');
                        Route::put('/rekam_medis/{rekam_medis}', 'App\Http\Controllers\RekamMedisController@update');
                        Route::delete('/rekam-medis/{rekam_medis}', 'App\Http\Controllers\RekamMedisController@destroy');
                        Route::get('/rekam_medis/cetak', 'App\Http\Controllers\RekamMedisController@cetak');
                });

        });     
                Route::get('/rekam-medis', 'App\Http\Controllers\RekamMedisController@index'); 


        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {
                        Route::get('/peralatan_medis/create', 'App\Http\Controllers\PeralatanMedisController@create');
                        Route::post('/peralatan_medis', 'App\Http\Controllers\PeralatanMedisController@store');
                        Route::get('/peralatan_medis/{peralatan_medis}', 'App\Http\Controllers\PeralatanMedisController@show');
                        Route::get('/peralatan_medis/{peralatan_medis}/edit', 'App\Http\Controllers\PeralatanMedisController@edit');
                        Route::put('/peralatan_medis/{peralatan_medis}', 'App\Http\Controllers\PeralatanMedisController@update');
                        Route::delete('/peralatan_medis/{peralatan_medis}', 'App\Http\Controllers\PeralatanMedisController@destroy');
        
                });
                        Route::get('/peralatan_medis', 'App\Http\Controllers\PeralatanMedisController@index');
        });

        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {
                        Route::get('/pengeluaran/create', 'App\Http\Controllers\PengeluaranController@create');
                        Route::post('/pengeluaran', 'App\Http\Controllers\PengeluaranController@store');
                        Route::get('/pengeluaran/{pengeluaran}', 'App\Http\Controllers\PengeluaranController@show');
                        Route::get('/pengeluaran/{pengeluaran}/edit', 'App\Http\Controllers\PengeluaranController@edit');
                        Route::put('/pengeluaran/{pengeluaran}', 'App\Http\Controllers\PengeluaranController@update');
                        Route::delete('/pengeluaran/{pengeluaran}', 'App\Http\Controllers\PengeluaranController@destroy');
                });
                        Route::get('/pengeluaran', 'App\Http\Controllers\PengeluaranController@index');
            
        });

                Route::middleware(['blockdokter'])->group(function () {
                        Route::group(['middleware' => 'blocksuper'], function () {
                           
                                Route::get('/pengambilan/create', 'App\Http\Controllers\PengambilanController@create');
                                Route::post('/pengambilan', 'App\Http\Controllers\PengambilanController@store');
                                Route::get('/pengambilan/{pengambilan}', 'App\Http\Controllers\PengambilanController@show');
                                Route::get('/pengambilan/{pengambilan}/edit', 'App\Http\Controllers\PengambilanController@edit');
                                Route::put('/pengambilan/{pengambilan}', 'App\Http\Controllers\PengambilanController@update');
                                Route::delete('/pengambilan/{pengambilan}', 'App\Http\Controllers\PengambilanController@destroy');
                        });
                        Route::get('/pengambilan', 'App\Http\Controllers\PengambilanController@index');
                });

        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () { 
                   
                        Route::get('/pendapatan/create', 'App\Http\Controllers\PendapatanController@create');
                        Route::post('/pendapatan', 'App\Http\Controllers\PendapatanController@store');
                        Route::get('/pendapatan/{pendapatan}', 'App\Http\Controllers\PendapatanController@show');
                        Route::get('/pendapatan/{pendapatan}/edit', 'App\Http\Controllers\PendapatanController@edit');
                        Route::put('/pendapatan/{pendapatan}', 'App\Http\Controllers\PendapatanController@update');
                        Route::delete('/pendapatan/{pendapatan}', 'App\Http\Controllers\PendapatanController@destroy');
                        Route::post('/cetak-pdf', 'App\Http\Controllers\PendapatanController@cetakPDF')->name('cetak-pdf');
                });
                        Route::get('/pendapatan', 'App\Http\Controllers\PendapatanController@index');

        });

        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {   
                        
                        Route::get('/perawatan/create', 'App\Http\Controllers\PerawatanLukaController@create');
                        Route::post('/perawatan', 'App\Http\Controllers\PerawatanLukaController@store');
                        Route::get('/perawatan/{perawatan}', 'App\Http\Controllers\PerawatanLukaController@show');
                        Route::get('/perawatan/{perawatan}/edit', 'App\Http\Controllers\PerawatanLukaController@edit');
                        Route::put('/perawatan/{id}', 'App\Http\Controllers\PerawatanLukaController@update')->name('perawatan.update');
                        Route::delete('/perawatan/{id}', 'App\Http\Controllers\PerawatanLukaController@destroy')->name('perawatan.destroy');
                        Route::post('/perawatan/{id}/selesai', 'App\Http\Controllers\PerawatanLukaController@selesai');
                });
                        Route::get('/perawatan', 'App\Http\Controllers\PerawatanLukaController@index');
        });

        Route::middleware(['blockdokter'])->group(function () {
                Route::group(['middleware' => 'blocksuper'], function () {   
                        
                        Route::get('/sunat/create', 'App\Http\Controllers\SunatController@create');
                        Route::post('/sunat', 'App\Http\Controllers\SunatController@store');
                        Route::get('/sunat/{sunat}', 'App\Http\Controllers\SunatController@show');
                        Route::get('/sunat/{sunat}/edit', 'App\Http\Controllers\SunatController@edit');
                        Route::put('/sunat/{sunat}', 'App\Http\Controllers\SunatController@update');
                        Route::delete('/sunat/{sunat}', 'App\Http\Controllers\SunatController@destroy');
                        Route::post('/sunat/{id}/selesai', 'App\Http\Controllers\SunatController@selesai');
                });
                        Route::get('/sunat', 'App\Http\Controllers\SunatController@index');
                
        });

                Route::get('/profile', 'App\Http\Controllers\ProfileController@index');
                Route::get('/profile/{profile}/edit', 'App\Http\Controllers\ProfileController@edit');
                Route::put('/profile/{id}', 'App\Http\Controllers\ProfileController@update');
                

                // Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

                Route::get('/janji', 'App\Http\Controllers\JanjiController@index');
                Route::delete('/janji/{janji}', 'App\Http\Controllers\JanjiController@destroy');
                Route::get('/janji/cetak',  'App\Http\Controllers\JanjiController@cetak');
                Route::post('/janji/{id}/terima', 'App\Http\Controllers\JanjiController@terimaJanji');
                Route::post('/janji/{id}/tidak-terima', 'App\Http\Controllers\JanjiController@tidakTerimaJanji');
                Route::get('/janji-pasien', 'App\Http\Controllers\JanjiController@index');
                Route::get('/janji/{janji}/edit', 'App\Http\Controllers\JanjiController@edit');
                Route::put('/janji/{janji}', 'App\Http\Controllers\JanjiController@update');

                

        
            });


Route::get('/janji/create', 'App\Http\Controllers\JanjiController@create');
Route::post('/janji', 'App\Http\Controllers\JanjiController@store');
Route::get('/laporan/{id}', 'App\Http\Controllers\LaporController@index')->name('laporan.index');

Route::get('/konfirmasis', 'App\Http\Controllers\JanjiController@konfirmasiJanji');



Route::get('/konfirmasi', function () {
    return view('admin.konfirmasi');
});
