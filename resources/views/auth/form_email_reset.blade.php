@extends('user_layouts.app')

@section('contents')
    <div class="wrapper"
        style="background-image: url('{{ asset('storage/img/background_smpn3.jpg') }}');
background-repeat: no-repeat; background-size: cover; background-position: center; padding-block: 100px; padding-inline: 25px;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-5 shadow-sm">
                        <h2 class="text-center mb-4">Reset Password</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('update.password') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-90 mx-auto rounded-pill">Update
                                    Password</button>
                            </div>
                            <div class="text-center">
                                <a href="{{ route('form') }}"
                                    class="text-decoration-none btn btn-secondary w-90 mx-auto rounded-pill">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
