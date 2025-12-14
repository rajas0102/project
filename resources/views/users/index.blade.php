@extends('layouts.app')

@section('title', 'Daftar Users')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Manajemen Users</h1>
    <div class="section-header-button">
      <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Users</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($users as $user)
                  <tr>
                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <span class="badge badge-{{ $user->role == 'owner' ? 'primary' : 'info' }}">
                        {{ ucfirst($user->role) }}
                      </span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                      <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      @if($user->id !== auth()->id())
                      <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" 
                                onclick="return confirm('Yakin hapus user ini?')">
                          <i class="fas fa-trash"></i> Hapus
                        </button>
                      </form>
                      @endif
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">Belum ada user</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection