<?php

namespace App\Http\Controllers\Tugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index() {
        return view('tugas.profile', [
            'title' => 'Tugas Profile',
            'nama' => 'Muhammad Farel Dwi Ramadhan',
            'alamat' => 'Dk. Sekopek, Kelurahan Polaman RT3/RW2, Kec. Mijen, Kota Semarang',
            'asalSekolah' => 'SMK N 3 Kendal',
            'foto' => 'backgroundHD.jpg',
            'bio' => 'Sulit bukan berarti tidak mungkin',
        ]);
    }
}
