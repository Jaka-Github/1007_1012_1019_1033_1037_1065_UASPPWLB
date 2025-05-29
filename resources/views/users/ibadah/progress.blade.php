@extends('layouts.users')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 py-12 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute top-20 -left-20 w-60 h-60 bg-purple-300/20 rounded-full blur-2xl"></div>
        <div class="absolute bottom-20 right-20 w-40 h-40 bg-indigo-300/30 rounded-full blur-xl"></div>
        <div class="absolute bottom-40 left-1/4 w-32 h-32 bg-blue-300/20 rounded-full blur-lg"></div>
        <!-- Floating geometric shapes -->
        <div class="absolute top-1/3 left-10 w-6 h-6 bg-white/20 rotate-45 animate-pulse"></div>
        <div class="absolute top-1/2 right-1/4 w-4 h-4 bg-purple-300/40 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/3 right-10 w-8 h-8 bg-indigo-300/30 rotate-12 animate-pulse" style="animation-delay: 2s;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">📊 Progress Ibadah</h2>
            <p class="text-purple-100 text-lg">Pantau perkembangan ibadah Anda dengan mudah</p>
        </div>

        @if($plans->isEmpty())
            <div class="max-w-2xl mx-auto bg-white/5 backdrop-blur-xl border border-white/10 text-white p-8 rounded-3xl text-center shadow-2xl hover:bg-white/10 transition-all duration-500">
                <div class="text-6xl mb-4">🕌</div>
                <h3 class="text-xl font-semibold mb-4">Belum Ada Rencana Ibadah</h3>
                <p class="text-purple-100 mb-6">Mulai perjalanan spiritual Anda dengan membuat rencana ibadah yang terstruktur</p>
                <a href="{{ route('ibadah.create') }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-purple-600 font-semibold rounded-xl hover:bg-purple-50 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Rencana Sekarang
                </a>
            </div>
        @else
            <div class="grid gap-8 max-w-4xl mx-auto">
                @foreach($plans as $plan)
                    @php
                        $totalTarget = $plan->target; // Total target dari model
                        $completedTarget = $plan->logs->where('status', true)->count(); // Target yang sudah selesai
                        $totalDuration = $plan->duration; // Total durasi hari
                        $totalLogs = $plan->logs->count(); // Total logs yang ada
                        
                        // Debug info - hapus setelah testing
                        // dd([
                        //     'total_target' => $totalTarget,
                        //     'completed_target' => $completedTarget,
                        //     'total_logs' => $totalLogs,
                        //     'logs_with_status_true' => $plan->logs->where('status', true)->count(),
                        //     'all_logs_status' => $plan->logs->pluck('status', 'date')
                        // ]);
                        
                        $progressPercent = $totalTarget > 0 ? round(($completedTarget / $totalTarget) * 100) : 0;
                        $progressPercent = is_numeric($progressPercent) && $progressPercent >= 0 ? $progressPercent : 0;
                        
                        // Determine progress color based on percentage
                        if ($progressPercent >= 80) {
                            $progressColor = 'from-emerald-400 via-emerald-500 to-emerald-600';
                            $ringColor = 'ring-emerald-400/50';
                        } elseif ($progressPercent >= 50) {
                            $progressColor = 'from-yellow-400 via-yellow-500 to-yellow-600';
                            $ringColor = 'ring-yellow-400/50';
                        } else {
                            $progressColor = 'from-rose-400 via-rose-500 to-rose-600';
                            $ringColor = 'ring-rose-400/50';
                        }
                    @endphp

                    <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl hover:shadow-3xl transition-all duration-500 hover:bg-white/10 hover:border-white/20 transform hover:-translate-y-1">
                        <!-- Header Card -->
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-2 flex items-center">
                                    <span class="w-3 h-3 bg-gradient-to-r {{ $progressColor }} rounded-full mr-3 animate-pulse"></span>
                                    {{ $plan->title }}
                                </h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white">
                                    {{ ucfirst($plan->category) }}
                                </span>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold text-white">{{ $progressPercent }}%</div>
                                <div class="text-purple-200 text-sm">Selesai</div>
                            </div>
                        </div>
                        
                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-white/10 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">{{ $plan->target }}</div>
                                <div class="text-purple-200 text-sm">Total Target</div>
                            </div>
                            <div class="bg-white/10 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">{{ $plan->duration }}</div>
                                <div class="text-purple-200 text-sm">Hari Durasi</div>
                            </div>
                            <div class="bg-white/10 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-white">{{ $completedTarget }}</div>
                                <div class="text-purple-200 text-sm">Target Selesai</div>
                            </div>
                        </div>

                        <!-- Periode -->
                        <div class="mb-6">
                            <p class="text-purple-100 text-center">
                                <span class="font-semibold">Periode:</span> 
                                {{ \Carbon\Carbon::parse($plan->start_date)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($plan->end_date)->format('d M Y') }}
                            </p>
                        </div>

                        <!-- Dynamic Progress Bar -->
                        <div class="relative mb-6">
                            <div class="w-full bg-white/20 rounded-full h-6 overflow-hidden shadow-inner backdrop-blur-sm">
                                <div 
                                    x-data="{ 
                                        width: 0,
                                        targetWidth: {{ $progressPercent }},
                                        init() {
                                            setTimeout(() => {
                                                this.width = this.targetWidth;
                                            }, 300);
                                        }
                                    }"
                                    x-bind:style="'width: ' + width + '%'"
                                    class="bg-gradient-to-r {{ $progressColor }} h-6 rounded-full shadow-lg transition-all duration-1000 ease-out relative overflow-hidden"
                                >
                                    <!-- Shimmer effect -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -skew-x-12 animate-shimmer"></div>
                                </div>
                            </div>
                            
                            <!-- Progress indicator -->
                            <div class="absolute -top-2 transition-all duration-1000 ease-out" 
                                 x-bind:style="'left: calc(' + width + '% - 20px)'"
                                 x-data="{ width: {{ $progressPercent }} }">
                                <div class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center transform -translate-y-1/2 ring-4 {{ $ringColor }}">
                                    <div class="text-xs font-bold text-purple-600">{{ $progressPercent }}%</div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Text -->
                        <div class="text-center">
                            <p class="text-white font-medium text-lg">
                                <span class="text-2xl font-bold bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">{{ $completedTarget }}</span>
                                <span class="text-purple-200"> dari </span>
                                <span class="text-2xl font-bold text-white">{{ $plan->target }}</span>
                                <span class="text-purple-200"> target selesai dalam </span>
                                <span class="text-xl font-bold text-white">{{ $plan->duration }}</span>
                                <span class="text-purple-200"> hari</span>
                            </p>
                            
                            @if($progressPercent == 100)
                                <div class="mt-4 inline-flex items-center px-4 py-2 bg-emerald-500/20 border border-emerald-400/30 rounded-full">
                                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-emerald-400 font-semibold">Target Tercapai! 🎉</span>
                                </div>
                            @elseif($progressPercent >= 75)
                                <div class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-500/20 border border-yellow-400/30 rounded-full">
                                    <svg class="w-5 h-5 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span class="text-yellow-400 font-semibold">Hampir Selesai! 💪</span>
                                </div>
                            @endif
                        </div>

                        <!-- Riwayat Log -->
                        @if($plan->logs->isNotEmpty())
                            <div class="mt-8 bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                                <h5 class="font-bold text-lg text-white mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-3 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    Riwayat Log ({{ $plan->logs->count() }} entries)
                                </h5>
                                
                                <div class="space-y-3 max-h-64 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-white/20 scrollbar-track-transparent">
                                    @foreach($plan->logs->sortByDesc('date') as $log)
                                        <div class="bg-white/10 backdrop-blur-sm rounded-xl border border-white/10 p-4 hover:bg-white/15 transition-all duration-300">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <div class="flex items-center mb-2">
                                                        <div class="text-white font-medium">
                                                            {{ $log->date->format('d M Y') }}
                                                        </div>
                                                        <div class="ml-3">
                                                            @if($log->status)
                                                                <span class="inline-flex items-center px-3 py-1 bg-emerald-500/20 border border-emerald-400/30 rounded-full text-emerald-300 text-sm font-medium">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                    </svg>
                                                                    Selesai
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-3 py-1 bg-rose-500/20 border border-rose-400/30 rounded-full text-rose-300 text-sm font-medium">
                                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                    </svg>
                                                                    Terlewat
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if($log->notes)
                                                        <p class="text-purple-200 text-sm bg-white/5 rounded-lg p-2 mt-2">
                                                            <span class="font-medium">Catatan:</span> {{ $log->notes }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <form method="POST" action="{{ route('ibadah.log.destroy', $log->id) }}" onsubmit="return confirm('Yakin hapus log ini?')" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="p-2 bg-rose-500/20 hover:bg-rose-500/30 border border-rose-400/30 text-rose-300 rounded-lg transition-all duration-300 hover:scale-105">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('ibadah.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-semibold rounded-xl hover:bg-white/20 transform hover:scale-105 transition-all duration-300 shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Rencana Ibadah
            </a>
        </div>
    </div>
</div>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%) skewX(-12deg); }
    100% { transform: translateX(200%) skewX(-12deg); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-10px) rotate(1deg); }
    66% { transform: translateY(-5px) rotate(-1deg); }
}

.animate-shimmer {
    animation: shimmer 2s infinite;
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}
</style>
@endsection