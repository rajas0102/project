<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        
        // Best Seller Products (Top 5 bulan ini)
        $bestSellerProducts = OrderItem::select(
                'menus.id',
                'menus.name',
                'menus.image',
                DB::raw('SUM(order_items.qty) as total_sold'),
                DB::raw('SUM(order_items.subtotal) as total_revenue')
            )
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->where('orders.status', 'selesai')
            ->whereMonth('orders.created_at', now()->month)
            ->whereYear('orders.created_at', now()->year)
            ->groupBy('menus.id', 'menus.name', 'menus.image')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
        
        // Revenue Chart Data (per bulan tahun ini)
        $revenueChartData = $this->getRevenueChartData();
        
        return view('dashboard.owner.index', compact(
            'totalOrders',
            'totalRevenue',
            'totalMenus',
            'todayOrders',
            'recentOrders',
            'bestSellerProducts',
            'revenueChartData'
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
    
    private function getRevenueChartData()
    {
        $year = now()->year;
        $months = [];
        $revenues = [];
        
        // Nama bulan dalam bahasa Indonesia
        $monthNames = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        
        // Ambil data revenue per bulan
        $monthlyRevenue = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as revenue')
            )
            ->where('status', 'selesai')
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('revenue', 'month')
            ->toArray();
        
        // Generate data untuk semua 12 bulan
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $monthNames[$i];
            $revenues[] = $monthlyRevenue[$i] ?? 0;
        }
        
        return [
            'labels' => $months,
            'data' => $revenues
        ];
    }
}