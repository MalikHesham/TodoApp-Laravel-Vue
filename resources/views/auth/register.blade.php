@extends('layouts.app') @section('content')
<div class="container-fluid card login-wrapper">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>

        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <form
                                method="POST"
                                action="{{ route('register') }}"
                            >
                                @csrf
                                <div class="form-label-group">
                                    <label
                                        for="name"
                                        class="col-md-4 col-form-label text-md-right"
                                    ></label>

                                    <input
                                        id="name"
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        autocomplete="name"
                                        placeholder="Name"
                                        autofocus
                                    />

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-label-group">
                                    <label
                                        for="email"
                                        class="col-md-4 col-form-label text-md-right"
                                    ></label>
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        placeholder="Email-Address"
                                        autocomplete="email"
                                    />

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-label-group">
                                    <label
                                        for="password"
                                        class="col-md-4 col-form-label text-md-right"
                                    ></label>
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        required
                                        placeholder="Password"
                                        autocomplete="new-password"
                                    />

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-label-group">
                                    <label
                                        for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right"
                                    ></label>

                                    <input
                                        id="password-confirm"
                                        type="password"
                                        class="form-control"
                                        name="password_confirmation"
                                        required
                                        placeholder="Confirm Password"
                                        autocomplete="new-password"
                                    />
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-lg btn-primary btn-block
                                           btn-login text-uppercase font-weight-bold mb-2"
                                >
                                    {{ __("Register") }}
                                </button>

                                <a
                                    class="btn btn-link p-1"
                                    href="{{ route('login') }}"
                                >
                                    {{ __("Already have an account?") }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
