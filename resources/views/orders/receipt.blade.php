<!DOCTYPE html>
<html>
<head>
  <title>Struk - {{ $order->order_number }}</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 0;
      padding: 20px;
    }
    .header {
      text-align: center;
      margin-bottom: 20px;
    }
    .header h2 {
      margin: 0;
    }
    .info {
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }
    table th, table td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    table th {
      background-color: #f2f2f2;
    }
    .total {
      text-align: right;
      font-size: 14px;
      font-weight: bold;
    }
    .footer {
      text-align: center;
      margin-top: 30px;
      font-size: 11px;
    }
    .dashed {
      border-top: 2px dashed #000;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <div class="header">
    <h2>COFFEE SHOP</h2>
    <p>Jl. Contoh No. 123, Jakarta<br>
    Telp: (021) 1234567</p>
  </div>

  <div class="dashed"></div>

  <div class="info">
    <table style="border: none;">
      <tr>
        <td width="100" style="border: none;">No. Order</td>
        <td style="border: none;">: {{ $order->order_number }}</td>
      </tr>
      <tr>
        <td style="border: none;">Tanggal</td>
        <td style="border: none;">: {{ $order->created_at->format('d/m/Y H:i') }}</td>
      </tr>
      <tr>
        <td style="border: none;">Kasir</td>
        <td style="border: none;">: {{ auth()->user()->name }}</td>
      </tr>
    </table>
  </div>

  <div class="dashed"></div>

  <table>
    <thead>
      <tr>
        <th>Item</th>
        <th style="text-align: center;">Qty</th>
        <th style="text-align: right;">Harga</th>
        <th style="text-align: right;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->orderItems as $item)
      <tr>
        <td>{{ $item->menu->name }}</td>
        <td style="text-align: center;">{{ $item->qty }}</td>
        <td style="text-align: right;">{{ number_format($item->price, 0, ',', '.') }}</td>
        <td style="text-align: right;">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="dashed"></div>

  <div class="total">
    <p>TOTAL: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
  </div>

  <div class="dashed"></div>

  <div class="footer">
    <p>Terima kasih atas kunjungan Anda!<br>
    Selamat menikmati hidangan</p>
  </div>
</body>
</html>