<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition login-page" style="background: linear-gradient(120deg, #d4f1f9, #6dd5ed); min-height: 50vh; max-height:110vh; display: flex; align-items: center; justify-content: center; padding: 20px;">
        <div class="login-container" style="width: 100%; max-width: 400px; background: rgba(255, 255, 255, 0.95); border-radius: 20px; box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); overflow: hidden;">
            <!-- Header Section -->
            <div class="login-header" style="background: #2a9d8f; padding: 10px; text-align: center; color: #fff; border-bottom: 5px solid #0288d1;">
                <img src="https://www.learnsoftbeliotechsolutions.co.ke/img/logo.png" alt="Logo" style="width: 70px; margin-bottom: 10px;">
                <h1 style="font-size: 24px; font-weight: bold; margin: 0; font-family:'Gill Sans';">ACADX</h1>
               
            </div>

            <!-- Form Section -->
            <div class="login-body" style="padding: 30px;">
                <p class="login-box-msg" style="font-size: 18px; text-align: center; color: #555;">Sign in to access your portal!</p>

                <form method="post" action="{{ url('/login') }}">
                    @csrf
                    <!-- Email Input -->
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="email" style="font-size: 14px; font-weight: 500; color: #00796b;">University Email</label>
                        <div class="input-group">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your university email"
                                class="form-control @error('email') is-invalid @enderror"
                                style="border-radius: 25px; padding: 12px; font-size: 14px;"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text" style="background: #0288d1; color: #fff; border-radius: 25px;">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label for="password" style="font-size: 14px; font-weight: 500; color: #00796b;">Password</label>
                        <div class="input-group">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                class="form-control @error('password') is-invalid @enderror"
                                style="border-radius: 25px; padding: 12px; font-size: 14px;"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text" style="background: #0288d1; color: #fff; border-radius: 25px;">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me and Submit -->
                    <div class="row align-items-center" style="margin-bottom: 20px;">
                        <div class="col-6">
                            <div class="form-check">
                                <input type="checkbox" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label" style="font-size: 14px; color: #555;">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary" style="background: #00796b; border-color: #00796b; border-radius: 25px; font-size: 16px; padding: 10px 20px;">Sign In</button>
                        </div>
                    </div>
                </form>

                <!-- Links -->
                <div>
                    <p>
                        <a href="{{ route('password.request') }}" class="text-left" style="color: #0288d1; font-size: 14px; margin-right:18%;">Forgot Password?</a>
                        <a href="{{ route('register') }}" class="text-right" style="color: #0288d1; font-size: 14px;">Register for a new account</a>
                    </p>
                    <p class="text-right">
                        
                    </p>
                </div>
            </div>
        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>