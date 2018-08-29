<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class HomelyController extends Controller
{
	public function getList() 
    {
        return view('user.list');
    }
}

