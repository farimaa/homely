<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\News;
use App\Models\Brand;
use App\Models\Baner;
use App\Models\User;
use App\Models\Factor;
use App\Models\Payment;

class MasterController extends Controller
{
	public function index() 
    {
        return view('homely.index');
    }

    public function contract() 
    {
        return view('homely.contract');
    }

    public function getLanguage($language)
    {
        if($language == 'fa' || $language == 'en'){
            session()->put('local_language', $language);
        }
        
        return redirect()->back();
    }
}

