<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition login-page" style="background: linear-gradient(120deg, #d4f1f9, #6dd5ed); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;">
        <div class="login-box" style="max-width: 400px; background: rgba(255, 255, 255, 0.95); border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
            <div class="login-logo">
                <!-- University Logo -->
                <img src="https://www.learnsoftbeliotechsolutions.co.ke/img/logo.png" alt="logo" style="max-width: 80px; margin-bottom: 10px;">
                <a href="{{ url('/') }}" style="font-size: 24px; font-weight: bold; color: #00796b;">
                    <span style="color: #0288d1;"></span>ACARDX
                </a>
            </div>
            <!-- /.login-logo -->

            <div class="card">
                <div class="card-body login-card-body" style="border-radius: 10px; padding: 30px;">
                    <p class="login-box-msg" style="font-size: 16px; color: #555;">Sign in to access your portal</p>

                    <form method="post" action="{{ url('/login') }}">
                        @csrf

                        <div class="input-group mb-4">
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="University Email"
                                class="form-control @error('email') is-invalid @enderror"
                                style="border-radius: 30px; padding: 10px 15px;"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-envelope" style="color: #0288d1;"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group mb-4">
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror"
                                style="border-radius: 30px; padding: 10px 15px;"
                            >
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-lock" style="color: #00796b;"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember" style="font-size: 14px;">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 30px; font-size: 16px; background-color: #00796b; border-color: #00796b;">Sign In</button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center">
                        <p class="mb-1">
                            <a href="{{ route('password.request') }}" style="font-size: 14px; color: #0288d1;">Forgot Password?</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ route('register') }}" style="font-size: 14px; color: #0288d1;">Register for a new membership</a>
                        </p>
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>

            <div class="text-center mt-3" style="font-size: 12px; color: #555;">
                <p>Need help? <a href="#" style="color: #0288d1;">Contact IT Support</a></p>
            </div>
        </div>
        <!-- /.login-box -->
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
