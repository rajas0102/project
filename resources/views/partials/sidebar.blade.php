<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
  <img src="{{ asset('backend/dist/assets/img/stisla-fill.png') }}" 
       alt="logo" 
       style="width: 30px; height: 30px; margin-right: 8px; vertical-align: middle; object-fit: contain;">
  <a href="{{ route('dashboard') }}">COFFEE SHOP</a>
</div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('dashboard') }}">CS</a>
    </div>
    
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-fire"></i> <span>Dashboard</span>
        </a>
      </li>

      @if(Auth::user()->role == 'owner')
      <!-- Menu khusus Owner -->
      <li class="menu-header">Management</li>
      
      <li class="{{ Request::is('categories*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fas fa-tags"></i> <span>Kategori</span>
        </a>
      </li>

      <li class="{{ Request::is('menus*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('menus.index') }}">
          <i class="fas fa-coffee"></i> <span>Menu</span>
        </a>
      </li>

      <li class="{{ Request::is('users*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="fas fa-users"></i> <span>Users</span>
        </a>
      </li>
      @endif

      <li class="menu-header">Orders</li>
      <li class="{{ Request::is('orders*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('orders.index') }}">
          <i class="fas fa-receipt"></i> <span>Semua Order</span>
        </a>
      </li>
    </ul>
  </aside>
</div>