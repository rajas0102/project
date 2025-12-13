<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isOwner()) {
            return $this->ownerDashboard();
        } else {
            return $this->kasirDashboard();
        }
    }
    
    private function ownerDashboard()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'selesai')->sum('total');
        $totalMenus = Menu::count();
        $todayOrders = Order::whereDate('created_at', today())->count();
        $recentOrders = Order::with('orderItems.menu')
            ->latest()
            ->take(10)
            ->get();
        
        return view('dashboard.owner.index', compact(
            'totalOrders',
            'totalRevenue',
            'totalMenus',
            'todayOrders',
            'recentOrders'
        ));
    }
    
    private function kasirDashboard()
    {
        $todayOrders = Order::whereDate('created_at', today())->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $todayRevenue = Order::where('status', 'selesai')
            ->whereDate('created_at', today())
            ->sum('total');
        $recentOrders = Order::with('orderItems.menu')
            ->latest()
            ->take(10)
            ->get();
        
        return view('dashboard.kasir.index', compact(
            'todayOrders',
            'pendingOrders',
            'todayRevenue',
            'recentOrders'
        ));
    }
}