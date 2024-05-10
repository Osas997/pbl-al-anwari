<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function __invoke()
    {
        // $santri = Santri::with(['angkatan', 'catering', 'diniyyah', 'syahriyyah'])->orderBy('nama_santri', 'asc')->get()->map(fn ($q) => $q->only(['id', 'no_nik', 'nama_santri', 'angkatan', 'catering', 'diniyyah', 'syahriyyah']));

        // return response()->json($santri);

        return view('app');
    }
}
