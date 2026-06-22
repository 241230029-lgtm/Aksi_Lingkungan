<?php

namespace App\Http\Controllers\Information;

use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index() { return view('information.index'); }
    public function show($id) { return view('information.detail'); }
}
