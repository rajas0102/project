@extends('layouts.app')

@section('title', 'Detail Order')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{ route('orders.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Order</h1>
    <div class="section-header-button">
      <a href="{{ route('orders.print', $order) }}" class="btn btn-warning" target="_blank">
        <i class="fas fa-print
        "></i> Cetak Struk
</a>
</div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Order #{{ $order->order_number }}</h4>
            <div class="card-header-action">
              <span class="badge badge-{{ $order->status == 'selesai' ? 'success' : 'warning' }} badge-lg">
                {{ ucfirst($order->status) }}
              </span>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-4">
              <div class="col-md-6">
                <h6>Informasi Order</h6>
                <table class="table table-sm">
                  <tr>
                    <td width="150">No. Order</td>
                    <td>: {{ $order->order_number }}</td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>: {{ $order->created_at->format('d F Y H:i') }}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>: <span class="badge badge-{{ $order->status == 'selesai' ? 'success' : 'warning' }}">
                      {{ ucfirst($order->status) }}
                    </span></td>
                  </tr>
                </table>
              </div>
            </div>
            <h6 class="mb-3">Detail Items</h6>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->orderItems as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->menu->name }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" class="text-right">Total:</th>
                <th>Rp {{ number_format($order->total, 0, ',', '.') }}</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      @if($order->status == 'pending')
      <div class="card-footer text-right">
        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="d-inline">
          @csrf
          @method('PATCH')
          <button type="submit" class="btn btn-success" onclick="return confirm('Tandai order ini sebagai selesai?')">
            <i class="fas fa-check"></i> Tandai Selesai
          </button>
        </form>
      </div>
      @endif
    </div>
  </div>
</div>
</div>
</section>
@endsection
````