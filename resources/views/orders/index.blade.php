@extends('layouts.app')

@section('title', 'Daftar Order')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Daftar Order</h1>
    @if(auth()->user()->role == 'kasir')
    <div class="section-header-button">
      <a href="{{ route('orders.create') }}" class="btn btn-primary">Buat Order Baru</a>
    </div>
    @endif
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Semua Order</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>No. Order</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($orders as $order)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
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
                      <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-eye"></i> Detail
                      </a>
                      @if($order->status == 'pending')
                      <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Selesaikan order ini?')">
                          <i class="fas fa-check"></i> Selesai
                        </button>
                      </form>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center">Belum ada order</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection