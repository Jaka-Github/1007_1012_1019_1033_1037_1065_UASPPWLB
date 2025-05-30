<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
            color: #6366f1;
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
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md glass-effect rounded-2xl shadow-2xl p-8 relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full -translate-y-16 translate-x-16 opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-400 to-indigo-400 rounded-full translate-y-12 -translate-x-12 opacity-20"></div>
        
        <div class="relative z-10">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-2">
                    Register
                </h2>
                <p class="text-gray-600 font-medium">Join us and start your journey</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div class="floating-label">
                    <input id="name" name="name" type="text" required autofocus autocomplete="name"
                        value="{{ old('name') }}" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="name">Full Name</label>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="floating-label">
                    <input id="email" name="email" type="email" required autocomplete="username"
                        value="{{ old('email') }}" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="email">Email Address</label>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="floating-label">
                    <input id="password" name="password" type="password" required autocomplete="new-password" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="password">Password</label>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="floating-label">
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder=" "
                        class="input-focus block w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-0 focus:outline-none text-gray-900 font-medium bg-white/50" />
                    <label for="password_confirmation">Confirm Password</label>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-200 hover:underline" 
                       href="{{ route('login') }}">
                        Already have an account?
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all duration-300 transform">
                        Create Account
                    </button>
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