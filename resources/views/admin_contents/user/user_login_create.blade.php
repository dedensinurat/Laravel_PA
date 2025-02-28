@extends('admin_layouts.app')

@section('title', 'Tambah User')

@section('contents')
    <div class="container mt-5">
        <form action="{{ route('user_login.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                    class="form-control @error('username') is-invalid @enderror">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Address</label>
                <input type="text" id="alamat" name="alamat"
                    class="form-control @error('alamat') is-invalid @enderror">
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_telepon">Phone Number</label>
                <input type="text" id="no_telepon" name="no_telepon"
                    class="form-control @error('no_telepon') is-invalid @enderror">
                @error('no_telepon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                    @foreach ($roles as $role)
                        @if ($role != 'guru')
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endif
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="image">Photo</label>
                <input type="file" id="image" name="image"
                    class="form-control-file @error('image') is-invalid @enderror"> <!-- Change 'foto' to 'image' -->
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
