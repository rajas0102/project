@extends('layouts.app')

@section('title', 'Kategori')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Kategori Menu</h1>
    <div class="section-header-button">
      <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Kategori</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Menu</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($categories as $category)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>{{ $category->menus_count }} menu</td>
                    <td>
                      <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kategori ini?')">
                          <i class="fas fa-trash"></i> Hapus
                        </button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">Belum ada kategori</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            {{ $categories->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection