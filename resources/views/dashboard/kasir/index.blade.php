@extends('layouts.app')

@section('title', 'Dashboard Kasir')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Kasir</h1>
  </div>

  <div class="row">
    <!-- Order Hari Ini -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Order Hari Ini</h4>
          </div>
          <div class="card-body">
            {{ $todayOrders }}
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Orders -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-clock"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Order Pending</h4>
          </div>
          <div class="card-body">
            {{ $pendingOrders }}
          </div>
        </div>
      </div>
    </div>

    <!-- Revenue Hari Ini -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Revenue Hari Ini</h4>
          </div>
          <div class="card-body">
            Rp {{ number_format($todayRevenue, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Orders -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Order Terbaru</h4>
          <div class="card-header-action">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">Buat Order Baru</a>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No. Order</th>
                  <th>Items</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentOrders as $order)
                <tr>
                  <td>{{ $order->order_number }}</td>
                  <td>{{ $order->orderItems->count() }} item(s)</td>
                  <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                  <td>
                    <span class="badge badge-{{ $order->status == 'selesai' ? 'success' : 'warning' }}">
                      {{ ucfirst($order->status) }}
                    </span>
                  </td>
                  <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                  <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">Detail</a>
                    @if($order->status == 'pending')
                    <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="d-inline">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Selesaikan order ini?')">Selesai</button>
                    </form>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">Belum ada order</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection