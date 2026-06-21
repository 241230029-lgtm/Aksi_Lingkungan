<?php

namespace App\Http\Controllers\Sharing;

use App\Http\Controllers\Controller;

class SharingController extends Controller
{
    public function index() { return view('sharing.index'); }
    public function show($id) { return view('sharing.detail'); }
}
