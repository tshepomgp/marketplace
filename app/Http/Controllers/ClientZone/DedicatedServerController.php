<?php

namespace App\Http\Controllers\ClientZone;

use App\Http\Controllers\Controller;
use Auth;

class DedicatedServerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's dedicated servers
        $servers = [];
        
        return view('clientzone.dedicated-servers', compact('servers', 'user'));
    }
}
