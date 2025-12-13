@extends('layouts.app')

@section('title', 'Tambah Menu')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{ route('menus.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah Menu</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Form Tambah Menu</h4>
          </div>
          <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama Menu</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required>
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                      <option value="">Pilih Kategori</option>
                      @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                          {{ $category->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                          rows="3">{{ old('description') }}</textarea>
                @error('description')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Harga</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Rp</div>
                      </div>
                      <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                             value="{{ old('price') }}" required>
                      @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gambar Menu</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Format: JPG, PNG. Max 2MB</small>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="control-label">Status Ketersediaan</div>
                <label class="custom-switch mt-2">
                  <input type="checkbox" name="is_available" value="1" class="custom-switch-input" 
                         {{ old('is_available', true) ? 'checked' : '' }}>
                  <span class="custom-switch-indicator"></span>
                  <span class="custom-switch-description">Menu Tersedia</span>
                </label>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection