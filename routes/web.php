<?php

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wilayah', function () {
    return view('wilayah', [
        'provinsi' => Provinsi::orderBy('nama')->get(),
        'kota' => Kota::with('provinsi')->orderBy('nama')->get(),
        'kecamatan' => Kecamatan::with('kota')->orderBy('nama')->get(),
        'kelurahan' => Kelurahan::with('kecamatan')->orderBy('nama')->get(),
    ]);
});

Route::post('/provinsi', function (Request $request) {
    Provinsi::create($request->validate([
        'nama' => ['required', 'string', 'max:255'],
    ]));

    return redirect('/wilayah')->with('success', 'Provinsi berhasil disimpan.');
});

Route::post('/kota', function (Request $request) {
    Kota::create($request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'provinsi_id' => ['required', 'exists:provinsi,id'],
    ]));

    return redirect('/wilayah')->with('success', 'Kota berhasil disimpan.');
});

Route::post('/kecamatan', function (Request $request) {
    Kecamatan::create($request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'kota_id' => ['required', 'exists:kota,id'],
    ]));

    return redirect('/wilayah')->with('success', 'Kecamatan berhasil disimpan.');
});

Route::post('/kelurahan', function (Request $request) {
    Kelurahan::create($request->validate([
        'nama' => ['required', 'string', 'max:255'],
        'kecamatan_id' => ['required', 'exists:kecamatan,id'],
    ]));

    return redirect('/wilayah')->with('success', 'Kelurahan berhasil disimpan.');
});
