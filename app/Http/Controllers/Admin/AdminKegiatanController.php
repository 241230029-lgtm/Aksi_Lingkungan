<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminKegiatanController extends Controller
{
    public function index() { return view('admin.kegiatan-index'); }
    public function verify($id) {}
    public function destroy($id) {}
}
