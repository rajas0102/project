@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Daftar Menu</h1>
    <div class="section-header-button">
      <a href="{{ route('menus.create') }}" class="btn btn-primary">Tambah Menu</a>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Semua Menu</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($menus as $menu)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" 
                             width="50" class="rounded">
                      @else
                        <div class="badge badge-secondary">No Image</div>
                      @endif
                    </td>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->category->name }}</td>
                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td>
                      <span class="badge badge-{{ $menu->is_available ? 'success' : 'danger' }}">
                        {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                      </span>
                    </td>
                    <td>
                      <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus menu ini?')">
                          <i class="fas fa-trash"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center">Belum ada menu</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            {{ $menus->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection