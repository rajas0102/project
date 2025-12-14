@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Profile</h1>
  </div>

  <div class="section-body">
    <div class="row">
      <!-- Update Profile Information -->
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Informasi Profile</h4>
          </div>
          <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <!-- Profile Photo -->
              <div class="form-group text-center mb-4">
                <div class="mb-3">
                  <img src="{{ $user->profile_photo_url }}" 
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
                  <label class="custom-file-label" for="profile-photo-input">Pilih Foto</label>
                  @error('profile_photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
              </div>

              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Role</label>
                <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                <small class="form-text text-muted">Role tidak dapat diubah</small>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Profile
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Update Password -->
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Ubah Password</h4>
          </div>
          <form action="{{ route('profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="current_password" 
                       class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" 
                       class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Minimal 6 karakter</small>
              </div>

              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-key"></i> Ubah Password
              </button>
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