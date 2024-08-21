<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorFormRequest;
use Illuminate\Http\Request;

class DoctorOrderController extends Controller
{
    public function create()
    {
        return view('doctor.doctor-form');
    }

}
