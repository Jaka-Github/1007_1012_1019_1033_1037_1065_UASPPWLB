<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-effect {
            backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-focus:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .floating-label {
            position: relative;
        }
        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            transform: translateY(-20px) scale(0.8);
            color: #3b82f6;
        }
        .floating-label label {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #9ca3af;
            font-weight: 500;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 4px;
        }

        .static-label label {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #3b82f6;
            font-weight: 500;
            pointer-events: none;
            background: white;
            padding: 0 4px;
            transform: translateY(55px) scale(0.8);
        }

    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md glass-effect rounded-2xl shadow-2xl p-8 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full -translate-y-16 translate-x-16 opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-300 to-blue-500 rounded-full translate-y-12 -translate-x-12 opacity-20"></div>
        
        <div class="relative z-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent mb-2">
                    Welcome Back
                </h2>
                <p class="text-gray-600 font-medium">Sign in to your account</p>
            </div>

            <!-- Session Status -->
            <div class="mb-4">
                <!-- Add session status here if needed -->
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="floating-label">
                    <input id="email" name="email" type="email" required autofocus autocomplete="username"
                        value="{{ old('email') }}" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="email">Email Address</label>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="static-label">
                    <input id="password" name="password" type="password" required autocomplete="current-password" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="password">Password</label>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" 
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-4 h-4" name="remember">
                        <span class="ml-2 text-sm text-gray-600 font-medium">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200 hover:underline" 
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full px-8 py-3 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 transform">
                        Sign In
                    </button>
                </div>

                <div class="text-center pt-4">
                    <span class="text-sm text-gray-600 font-medium">
                        Don't have an account?
                    </span>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-200 hover:underline ml-1">
                        Register here
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add smooth animations when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = document.querySelectorAll('input');
            
            // Animate form entrance
            form.style.opacity = '0';
            form.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                form.style.transition = 'all 0.6s ease';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
            }, 100);

            // Add ripple effect to button
            const button = document.querySelector('button[type="submit"]');
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>

    <style>
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>