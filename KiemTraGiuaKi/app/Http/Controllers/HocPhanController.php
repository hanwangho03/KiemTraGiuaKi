<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HocPhan;

class HocPhanController extends Controller
{
    public function index()
    {
        $hocphans = HocPhan::all();
        return view('hocphans.index', compact('hocphans'));
    }
}
