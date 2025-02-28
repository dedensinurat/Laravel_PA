@extends('user_layouts.app')

@section('contents')
    <div class="wrapper"
        style="background-image: url('{{ asset('storage/img/background_smpn3.jpg') }}');
background-repeat: no-repeat; background-size: cover; background-position: center; padding-block: 100px; padding-inline: 25px">
        <div class="container py-5">
            @include('message')
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-5 shadow-sm">
                        <h2 class="text-center mb-4">Ganti Password</h2>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Username') }}</label>
                                <input id="username" type="text"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" required autocomplete="username"
                                    autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Alamat Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit"
                                    class="btn btn-primary w-50 mx-auto rounded-pill">{{ __('Submit') }}</button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('form') }}"
                                    class="text-decoration-none btn btn-secondary w-50 mx-auto rounded-pill">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
