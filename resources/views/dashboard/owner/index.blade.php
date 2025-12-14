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
            {{ $totalOrders }}
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
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
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
            {{ $totalMenus }}
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
            {{ $todayOrders }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Grafik Pendapatan & Best Seller -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <h4>Grafik Pendapatan</h4>
        </div>
        <div class="card-body">
          <canvas id="revenueChart" height="158"></canvas>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="card gradient-bottom">
        <div class="card-header">
          <h4>Best Seller Produk</h4>
          <div class="card-header-action dropdown">
            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Bulan Ini</a>
            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
              <li class="dropdown-title">Pilih Period</li>
              <li><a href="#" class="dropdown-item">Hari Ini</a></li>
              <li><a href="#" class="dropdown-item">Minggu Ini</a></li>
              <li><a href="#" class="dropdown-item active">Bulan Ini</a></li>
            </ul>
          </div>
        </div>
        <div class="card-body" id="top-5-scroll" style="max-height: 400px; overflow-y: auto;">
          <ul class="list-unstyled list-unstyled-border">
            @forelse($bestSellerProducts as $product)
            <li class="media">
              <img class="mr-3 rounded" width="55" 
                   src="{{ $product->image ? asset('storage/' . $product->image) : asset('backend/dist/assets/img/products/product-1-50.png') }}" 
                   alt="{{ $product->name }}">
              <div class="media-body">
                <div class="float-right">
                  <div class="font-weight-600 text-muted text-small">{{ $product->total_sold }} Terjual</div>
                </div>
                <div class="media-title">{{ $product->name }}</div>
                <div class="mt-1">
                  <div class="budget-price">
                    <div class="budget-price-square bg-primary" data-width="{{ $totalRevenue > 0 ? min(($product->total_revenue / $totalRevenue) * 100, 100) : 0 }}"></div>
                    <div class="budget-price-label">Rp {{ number_format($product->total_revenue, 0, ',', '.') }}</div>
                  </div>
                </div>
              </div>
            </li>
            @empty
            <li class="text-center text-muted py-3">Belum ada data penjualan bulan ini</li>
            @endforelse
          </ul>
        </div>
        <div class="card-footer pt-3 d-flex justify-content-center">
          <div class="budget-price justify-content-center">
            <div class="budget-price-square bg-primary" data-width="20"></div>
            <div class="budget-price-label">Total Pendapatan</div>
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
                @forelse($recentOrders as $order)
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
// Data dari Controller
var revenueData = @json($revenueChartData);

// Grafik Pendapatan
var ctx = document.getElementById("revenueChart").getContext('2d');
var revenueChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: revenueData.labels,
    datasets: [{
      label: 'Pendapatan',
      data: revenueData.data,
      borderWidth: 2,
      backgroundColor: 'rgba(63,82,227,.8)',
      borderColor: 'transparent',
      pointBorderColor: '#fff',
      pointBackgroundColor: 'rgba(63,82,227,.8)',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          callback: function(value) {
            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
          }
        }
      }],
      xAxes: [{
        gridLines: {
          display: false
        }
      }]
    },
    tooltips: {
      callbacks: {
        label: function(tooltipItem) {
          return 'Rp ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
      }
    }
  }
});

// Initialize budget price bars
$(document).ready(function() {
  $('.budget-price-square').each(function() {
    var width = $(this).data('width') + '%';
    $(this).css('width', width);
  });
});
</script>
@endpush