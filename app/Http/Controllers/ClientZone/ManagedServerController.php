<?php

namespace App\Http\Controllers\ClientZone;

use App\Http\Controllers\Controller;
use Auth;

class ManagedServerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get user's managed servers (from orders or custom table)
        $servers = []; // Replace with actual query
        
        return view('clientzone.managed-servers', compact('servers', 'user'));
    }
}
