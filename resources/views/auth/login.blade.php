@extends('layouts.app') @section('content')

<div class="container-fluid card login-wrapper">
    <div class="row no-gutter">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>

        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
                            <h3 class="login-heading">
                                “Do what you can, with what you have, where you
                                are.”
                            </h3>
                            <br />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-label-group">
                                    <input
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        placeholder="Email address"
                                        autocomplete="email"
                                        autofocus
                                    />
                                </div>

                                <div class="form-label-group">
                                    <input
                                        id="password"
                                        type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        placeholder="Password"
                                        required
                                        autocomplete="current-password"
                                    />
                                </div>

                                <div class="form-group">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                            type="checkbox" name="remember"
                                            id="remember"
                                            {{
                                                old("remember")
                                                    ? "checked"
                                                    : ""
                                            }}>

                                            <label
                                                class="form-check-label"
                                                for="remember"
                                            >
                                                {{ __("Keep me logged in") }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('email') ||
                                $errors->has('password'))
                                <span class="text-danger">
                                    <strong>{{
                                        "Wrong email or password."
                                    }}</strong></span
                                >
                                @endif

                                <button
                                    type="submit"
                                    class="btn btn-lg btn-success btn-block
                                           btn-login text-uppercase font-weight-bold mb-2"
                                >
                                    {{ __("Login") }}
                                </button>

                                @if (Route::has('password.request'))
                                <a
                                    class="btn btn-link p-1"
                                    href="{{ route('password.request') }}"
                                >
                                    {{ __("Forgot Your Password?") }}
                                </a>
                                @endif
                                <a
                                    class="btn btn-link p-1"
                                    href="{{ route('register') }}"
                                >
                                    {{ __("Don't have an account?") }}
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
