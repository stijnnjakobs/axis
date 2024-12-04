<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $services = $user->orders()
            ->with(['products', 'products.product'])
            ->latest()
            ->get();
        // Haal services op met eager loading
        return view('clients.services.index', compact('services'));
    }
} 