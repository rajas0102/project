@extends('layouts.app')

@section('title', 'Buat Order Baru')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{ route('orders.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Buat Order Baru</h1>
  </div>

  <div class="section-body">
    <form id="orderForm" action="{{ route('orders.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Pilih Menu</h4>
            </div>
            <div class="card-body">
              @foreach($menus->groupBy('category.name') as $categoryName => $categoryMenus)
              <div class="mb-4">
                <h6 class="mb-3">{{ $categoryName }}</h6>
                <div class="row">
                  @foreach($categoryMenus as $menu)
                  <div class="col-md-6 mb-3">
                    <div class="card menu-item" style="cursor: pointer;" 
                         data-id="{{ $menu->id }}" 
                         data-name="{{ $menu->name }}" 
                         data-price="{{ $menu->price }}">
                      <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                          @if($menu->image)
                          <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" 
                               width="60" class="rounded mr-3">
                          @else
                          <div class="avatar bg-secondary mr-3">
                            <i class="fas fa-utensils"></i>
                          </div>
                          @endif
                          <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $menu->name }}</h6>
                            <small class="text-muted">Rp {{ number_format($menu->price, 0, ',', '.') }}</small>
                          </div>
                          <button type="button" class="btn btn-sm btn-primary add-item">
                            <i class="fas fa-plus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card sticky-top" style="top: 20px;">
            <div class="card-header">
              <h4>Order Summary</h4>
            </div>
            <div class="card-body">
              <div id="orderItems">
                <p class="text-muted text-center">Belum ada item dipilih</p>
              </div>
              <hr>
              <div class="d-flex justify-content-between align-items-center">
                <h5>Total:</h5>
                <h5 id="totalAmount">Rp 0</h5>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary btn-block" id="submitBtn" disabled>
                <i class="fas fa-check"></i> Buat Order
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

@push('scripts')
<script>
let orderItems = [];

document.querySelectorAll('.add-item').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.stopPropagation();
    const card = this.closest('.menu-item');
    const menuId = card.dataset.id;
    const menuName = card.dataset.name;
    const menuPrice = parseFloat(card.dataset.price);

    const existingItem = orderItems.find(item => item.menu_id == menuId);
    
    if (existingItem) {
      existingItem.qty++;
    } else {
      orderItems.push({
        menu_id: menuId,
        name: menuName,
        price: menuPrice,
        qty: 1
      });
    }

    updateOrderSummary();
  });
});

function updateOrderSummary() {
  const container = document.getElementById('orderItems');
  const totalEl = document.getElementById('totalAmount');
  const submitBtn = document.getElementById('submitBtn');

  if (orderItems.length === 0) {
    container.innerHTML = '<p class="text-muted text-center">Belum ada item dipilih</p>';
    totalEl.textContent = 'Rp 0';
    submitBtn.disabled = true;
    return;
  }

  let html = '';
  let total = 0;

  orderItems.forEach((item, index) => {
    const subtotal = item.price * item.qty;
    total += subtotal;

    html += `
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="flex-grow-1">
          <div><strong>${item.name}</strong></div>
          <small class="text-muted">Rp ${item.price.toLocaleString('id-ID')}</small>
        </div>
        <div class="btn-group btn-group-sm">
          <button type="button" class="btn btn-outline-secondary" onclick="decreaseQty(${index})">-</button>
          <button type="button" class="btn btn-outline-secondary" disabled>${item.qty}</button>
          <button type="button" class="btn btn-outline-secondary" onclick="increaseQty(${index})">+</button>
        </div>
      </div>
      <input type="hidden" name="items[${index}][menu_id]" value="${item.menu_id}">
      <input type="hidden" name="items[${index}][qty]" value="${item.qty}">
    `;
  });

  container.innerHTML = html;
  totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
  submitBtn.disabled = false;
}

function increaseQty(index) {
  orderItems[index].qty++;
  updateOrderSummary();
}

function decreaseQty(index) {
  if (orderItems[index].qty > 1) {
    orderItems[index].qty--;
  } else {
    orderItems.splice(index, 1);
  }
  updateOrderSummary();
}
</script>
@endpush
@endsection