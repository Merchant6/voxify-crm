<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorOrderController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('doctor.doctor-form');
    }
}
