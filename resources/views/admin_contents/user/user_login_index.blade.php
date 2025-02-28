@extends('admin_layouts.app')

@section('title', 'Manage Users')

@section('contents')
    <div class="container mt-5">
        <div class="mb-4">
            <a href="{{ route('user_login.create') }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>

        @foreach ($users->groupBy('role') as $role => $roleUsers)
            <div class="mb-5">
                <h2 class="mb-4 text-uppercase">{{ $role }}</h2>
                <hr class="my-4" style="border-top: 2px solid #ddd;">
                <div class="row">
                    @foreach ($roleUsers as $user)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card user-card shadow-sm">
                                <img src="{{ asset('storage/' . $user->image) }}" class="card-img-top" alt="User Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $user->username }}</h5>
                                    <p class="card-text">{{ $user->email }}</p>
                                    <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-info btn-sm mr-1" title="Detail"
                                            data-toggle="modal" data-target="#detailModal{{ $user->id_user }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm mr-1" title="Edit"
                                            data-toggle="modal" data-target="#editModal{{ $user->id_user }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('user_login.destroy', $user->id_user) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn"
                                                data-message="Apakah Anda yakin ingin menghapus data guru ini?"><i
                                                    class="fas fa-trash-alt"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $user->id_user }}" tabindex="-1" role="dialog"
                            aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel">Detail User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Username</th>
                                                    <td>{{ $user->username }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Role</th>
                                                    <td>{{ $user->role }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td>{{ $user->no_telepon }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{ $user->alamat }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Created At</th>
                                                    <td>{{ $user->created_at->format('d M Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Updated At</th>
                                                    <td>{{ $user->updated_at->format('d M Y H:i:s') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Login</th>
                                                    <td>{{ $user->last_login instanceof \Carbon\Carbon ? $user->last_login->format('d-m-Y H:i:s') : ($user->last_login ? $user->last_login : 'Never Logged In') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $user->id_user }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Edit form -->
                                        <form id="updateForm{{ $user->id_user }}"
                                            action="{{ route('user_login.update', $user->id_user) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="edit_username">Username</label>
                                                <input type="text" id="edit_username" name="username"
                                                    value="{{ $user->username }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_email">Email</label>
                                                <input type="email" id="edit_email" name="email"
                                                    value="{{ $user->email }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_alamat">Alamat</label>
                                                <input type="text" id="edit_alamat" name="alamat"
                                                    value="{{ $user->alamat }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_no_telepon">Phone Number</label>
                                                <input type="text" id="edit_no_telepon" name="no_telepon"
                                                    value="{{ $user->no_telepon }}" class="form-control">
                                            </div>                                          

                                            <div class="form-group">
                                                <label for="edit_image">Photo</label>
                                                <input type="file" id="edit_image" name="image"
                                                    class="form-control-file">
                                                @if ($user->image)
                                                    <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                                        class="mt-2" style="max-width: 200px;">
                                                @endif
                                            </div>
                                            <button type="button" class="btn btn-primary mt-2"
                                                onclick="confirmUpdate('updateForm{{ $user->id_user }}')">Simpan
                                                Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="my-4" style="border-top: 2px solid #ddd;">
            </div>
        @endforeach
    </div>

@endsection

