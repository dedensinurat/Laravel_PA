@extends('user_layouts.app')

@section('contents')
    <div class="wrapper"
        style="background-image: url('{{ asset('storage/img/background_smpn3.jpg') }}');
background-repeat: no-repeat; background-size: cover; background-position: center; padding-block: 100px; padding-inline: 25px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-5 shadow-sm">
                        <h1 class="text-center mb-4">Login</h1>

                        @include('message')

                        <form action="{{ route('login') }}" method="POST" class="rounded">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control form-control-sm"
                                    placeholder="Masukkan Username anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-sm"
                                    placeholder="Masukkan Alamat E-mail anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-sm"
                                    placeholder="Masukkan Password yang valid" required>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-50 mx-auto rounded-pill">Login</button>
                            </div>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('reset.password') }}" class="text-decoration-none">Lupa Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
