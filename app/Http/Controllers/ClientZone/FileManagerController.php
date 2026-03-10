<?php

namespace App\Http\Controllers\ClientZone;

use App\Http\Controllers\Controller;
use Auth;

class FileManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('clientzone.file-manager', compact('user'));
    }
}
