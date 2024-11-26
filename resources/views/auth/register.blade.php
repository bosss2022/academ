<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition register-page" style="background: linear-gradient(120deg, #d4f1f9, #6dd5ed); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;">
        <div class="register-box" style="max-width: 400px; background: rgba(255, 255, 255, 0.95); border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
            <div class="register-logo">
                <img src="https://www.learnsoftbeliotechsolutions.co.ke/img/logo.png" alt="logo" style="max-width: 80px; margin-bottom: 10px;">
                <a href="{{ url('/') }}" style="font-size: 24px; font-weight: bold; color: #00796b;">
                    <span style="color: #0288d1;"></span>ACARDX
                </a>
            </div>

            <div class="card">
                <div class="card-body register-card-body" style="border-radius: 10px; padding: 30px;">
                    <p class="login-box-msg" style="font-size: 16px; color: #555;">Register a new membership</p>

                    <form method="post" action="{{ route('register') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input 
                                type="text" 
                                name="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                placeholder="Full name"
                                style="border-radius: 30px; padding: 10px 15px;">
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-user" style="color: #0288d1;"></span>
                                </div>
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Email"
                                style="border-radius: 30px; padding: 10px 15px;">
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-envelope" style="color: #00796b;"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input 
                                type="password" 
                                name="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Password"
                                style="border-radius: 30px; padding: 10px 15px;">
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-lock" style="color: #0288d1;"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                class="form-control" 
                                placeholder="Retype password"
                                style="border-radius: 30px; padding: 10px 15px;">
                            <div class="input-group-append">
                                <div class="input-group-text" style="border-radius: 30px 0 0 30px;">
                                    <span class="fas fa-lock" style="color: #00796b;"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms" style="font-size: 14px;">
                                        I agree to the <a href="#" style="color: #0288d1;">terms</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 30px; font-size: 16px; background-color: #00796b; border-color: #00796b;">Register</button>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route('login') }}" class="text-center" style="font-size: 14px; color: #0288d1;">I already have a membership</a>
                </div>
            </div>

            <div class="text-center mt-3" style="font-size: 12px; color: #555;">
                <p>Need help? <a href="#" style="color: #0288d1;">Contact IT Support</a></p>
            </div>
        </div>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
