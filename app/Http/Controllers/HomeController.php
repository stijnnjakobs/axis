<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Haal services op met eager loading
        $services = $user->orders()
            ->with(['products', 'products.product'])
            ->latest()
            ->get();

        // Tel actieve producten
        $activeProductsCount = $services->sum(function($service) {
            return $service->products->where('status', 'paid')->count();
        });
        $invoices = $user->invoices()
            ->whereIn('status', ['pending', 'suspended'])
            ->get();

        return view('clients.home', compact('services', 'invoices', 'announcements', 'activeProductsCount'));
    }
} 