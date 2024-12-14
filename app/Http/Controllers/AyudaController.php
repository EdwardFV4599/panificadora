<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AyudaController extends Controller
{
    public function index()
    {
        return redirect('/ayuda/index.htm');
    }
}
