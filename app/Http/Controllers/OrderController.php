<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.menu')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::where('is_available', true)->with('category')->get();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.qty' => 'required|integer|min:1'
        ]);

        $total = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $menu = Menu::find($item['menu_id']);
            $subtotal = $menu->price * $item['qty'];
            $total += $subtotal;

            $orderItems[] = [
                'menu_id' => $menu->id,
                'qty' => $item['qty'],
                'price' => $menu->price,
                'subtotal' => $subtotal
            ];
        }

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'total' => $total,
            'status' => 'pending'
        ]);

        $order->orderItems()->createMany($orderItems);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        $order->load('orderItems.menu');
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Order $order)
    {
        $order->update(['status' => 'selesai']);

        return redirect()->route('orders.index')
            ->with('success', 'Status order berhasil diupdate');
    }

    public function printReceipt(Order $order)
    {
        $order->load('orderItems.menu');
        
        $pdf = Pdf::loadView('orders.receipt', compact('order'));
        
        return $pdf->download('receipt-' . $order->order_number . '.pdf');
    }
}