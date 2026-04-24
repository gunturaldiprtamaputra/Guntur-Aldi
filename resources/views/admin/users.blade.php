<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">👥 Kelola User</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <table class="table mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Ubah Role</th></tr>
            </thead>
            <tbody>
                @foreach($users as $i => $u)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge {{ $u->role==='admin' ? 'bg-danger' : 'bg-secondary' }}">
                            {{ $u->role }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.users.role', $u->id) }}" method="POST" class="d-flex gap-1">
                            @csrf
                            <select name="role" class="form-select form-select-sm" style="width:120px">
                                <option value="user"  {{ $u->role=='user' ?'selected':'' }}>user</option>
                                <option value="admin" {{ $u->role=='admin'?'selected':'' }}>admin</option>
                            </select>
                            <button class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>