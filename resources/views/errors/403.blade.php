{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>403 - Akses Dibatasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        
        .calm-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .subtle-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }
        
        .error-accent {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-left: 3px solid #f87171;
        }
        
        .calm-button {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        
        .calm-button:hover {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        .secondary-button {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #6b7280;
        }
        
        .secondary-button:hover {
            background: #f9fafb;
            border-color: #9ca3af;
            color: #374151;
        }
        
        .floating-element {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #f87171;
            border-radius: 50%;
            opacity: 0.3;
            animation: gentle-float 8s ease-in-out infinite;
        }
        
        @keyframes gentle-float {
            0%, 100% { 
                transform: translateY(0px) translateX(0px);
                opacity: 0.3;
            }
            25% { 
                transform: translateY(-15px) translateX(5px);
                opacity: 0.6;
            }
            50% { 
                transform: translateY(-8px) translateX(-3px);
                opacity: 0.4;
            }
            75% { 
                transform: translateY(-20px) translateX(2px);
                opacity: 0.5;
            }
        }
        
        .pulse-subtle {
            animation: pulse-subtle 4s ease-in-out infinite;
        }
        
        @keyframes pulse-subtle {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 0.8; }
        }
        
        .error-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #fca5a5 0%, #f87171 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(248, 113, 113, 0.2);
        }
        
        .breathe {
            animation: breathe 6s ease-in-out infinite;
        }
        
        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="calm-gradient min-h-screen flex items-center justify-center p-6">
    
    <!-- Subtle floating elements -->
    <div class="floating-element top-1/4 left-1/4" style="animation-delay: 0s;"></div>
    <div class="floating-element top-1/3 right-1/3" style="animation-delay: 2s;"></div>
    <div class="floating-element bottom-1/3 left-1/3" style="animation-delay: 4s;"></div>
    <div class="floating-element bottom-1/4 right-1/4" style="animation-delay: 6s;"></div>

    <div class="subtle-card rounded-2xl p-8 max-w-lg w-full">
        
        <!-- Subtle error icon -->
        <div class="error-icon mb-6 breathe">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
        </div>

        <!-- Error code dengan style kalem -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-light text-gray-700 mb-2">403</h1>
            <h2 class="text-lg font-medium text-gray-600">Akses Dibatasi</h2>
        </div>
        
        <!-- Error message dalam box subtle -->
        <div class="error-accent rounded-lg p-4 mb-6 pulse-subtle">
            <p class="text-gray-700 text-sm leading-relaxed">
                Sepertinya Anda tidak memiliki izin untuk mengakses halaman ini. 
                Tidak apa-apa, ini bukan kesalahan Anda.
            </p>
        </div>

        <!-- Suggestion yang kalem -->
        <div class="mb-8">
            <p class="text-gray-600 text-sm mb-4">Yang bisa Anda lakukan:</p>
            <div class="space-y-2 text-sm text-gray-500">
                <div class="flex items-center">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-3"></div>
                    <span>Kembali ke halaman sebelumnya</span>
                </div>
                <div class="flex items-center">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-3"></div>
                    <span>Hubungi administrator jika diperlukan</span>
                </div>
                <div class="flex items-center">
                    <div class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-3"></div>
                    <span>Coba akses halaman lain</span>
                </div>
            </div>
        </div>

        <!-- Buttons dengan style kalem -->
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ url('/') }}"  
               class="calm-button flex-1 text-white px-6 py-2.5 rounded-lg text-sm font-medium text-center transition-all">
                Beranda / Dashboard
            </a>
        </div>

        <!-- Footer info yang subtle -->
        <div class="mt-8 pt-4 border-t border-gray-200 text-center">
            <p class="text-xs text-gray-400">
                Error 403 • {{ date('d M Y, H:i') }}
            </p>
        </div>
    </div>
</body>
</html>