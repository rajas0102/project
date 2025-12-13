@extends('layouts.app')

@section('title', 'Dashboard Owner')

@push('css-libraries')
  <link rel="stylesheet" href="{{ asset('backend/dist/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
@endpush

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Dashboard Owner</h1>
  </div>

  <div class="row">
    <!-- Total Orders -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Order</h4>
          </div>
          <div class="card-body">
            {{ $totalOrders ?? 0 }}
          </div>
        </div>
      </div>
    </div>

    <!-- Total Revenue -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Revenue</h4>
          </div>
          <div class="card-body">
            Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>

    <!-- Total Menu -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="fas fa-coffee"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Menu</h4>
          </div>
          <div class="card-body">
            {{ $totalMenus ?? 0 }}
          </div>
        </div>
      </div>
    </div>

    <!-- Order Hari Ini -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="fas fa-fire"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Order Hari Ini</h4>
          </div>
          <div class="card-body">
            {{ $todayOrders ?? 0 }}
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
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No. Order</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                @forelse($recentOrders ?? [] as $order)
                <tr>
                  <td>{{ $order->order_number }}</td>
                  <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                  <td>
                    <span class="badge badge-{{ $order->status == 'selesai' ? 'success' : 'warning' }}">
                      {{ ucfirst($order->status) }}
                    </span>
                  </td>
                  <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">Belum ada order</td>
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

@push('js-libraries')
  <script src="{{ asset('backend/dist/assets/modules/chart.min.js') }}"></script>
@endpush

@push('scripts')
<script>
  // Custom JS kalau butuh
  console.log('Dashboard Owner loaded');
</script>
@endpush