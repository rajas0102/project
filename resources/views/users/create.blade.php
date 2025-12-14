@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<section class="section">
  <div class="section-header">
    <div class="section-header-back">
      <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Tambah User</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Form Tambah User</h4>
          </div>
          <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <!-- Profile Photo -->
              <div class="form-group text-center mb-4">
                <div class="mb-3">
                  <img src="{{ asset('backend/dist/assets/img/avatar/avatar-1.png') }}" 
                       alt="Profile Photo" 
                       class="rounded-circle" 
                       width="150" 
                       height="150"
                       style="object-fit: cover; border: 3px solid #6777ef;"
                       id="profile-photo-preview">
                </div>
                <div class="custom-file" style="max-width: 300px; margin: 0 auto;">
                  <input type="file" 
                         name="profile_photo" 
                         class="custom-file-input @error('profile_photo') is-invalid @enderror" 
                         id="profile-photo-input"
                         accept="image/*">
                  <label class="custom-file-label" for="profile-photo-input">Pilih Foto Profile</label>
                  @error('profile_photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
              </div>

              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name') }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                  <option value="">Pilih Role</option>
                  <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                  <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
                @error('role')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
// Preview profile photo before upload
document.getElementById('profile-photo-input').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('profile-photo-preview').src = e.target.result;
    }
    reader.readAsDataURL(file);
    
    // Update label text
    const fileName = file.name;
    const label = document.querySelector('.custom-file-label');
    label.textContent = fileName;
  }
});
</script>
@endpush