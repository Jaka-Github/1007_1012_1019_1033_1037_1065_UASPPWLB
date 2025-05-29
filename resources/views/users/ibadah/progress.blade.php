@extends('layouts.users')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-semibold mb-8 text-center">📊 Progress Ibadah</h2>

    @if($plans->isEmpty())
        <div class="bg-blue-100 text-blue-700 p-4 rounded-md text-center">
            Belum ada rencana ibadah. Yuk <a href="{{ route('ibadah.create') }}" class="text-blue-600 underline hover:text-blue-800">buat sekarang</a>!
        </div>
    @else
        <div class="space-y-6">
            @foreach($plans as $plan)
                @php
                    $totalLogs = $plan->logs->count();
                    $doneLogs = $plan->logs->where('is_done', true)->count();
                    $progressPercent = $totalLogs > 0 ? round(($doneLogs / $totalLogs) * 100) : 0;
                    // Pastikan progressPercent valid dan minimal 0
                    $progressPercent = is_numeric($progressPercent) && $progressPercent >= 0 ? $progressPercent : 0;
                @endphp

                <div class="bg-white shadow-md rounded-lg p-6 border border-gray-200">
                    <h3 class="text-xl font-bold mb-2">{{ $plan->title }}</h3>
                    <p class="text-gray-600 mb-4">
                        <span class="font-semibold">Kategori:</span> {{ ucfirst($plan->category) }}<br>
                        <span class="font-semibold">Target:</span> {{ $plan->target }}<br>
                        <span class="font-semibold">Durasi:</span> {{ $plan->duration }} hari<br>
                        <span class="font-semibold">Periode:</span> {{ \Carbon\Carbon::parse($plan->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($plan->end_date)->format('d M Y') }}
                    </p>

                    @php
                        $progressPercent = $totalLogs > 0 ? round(($doneLogs / $totalLogs) * 100) : 0;
                    @endphp

                    <div class="w-full bg-gray-300 rounded-full h-8 mb-4 overflow-hidden shadow-inner">
                        <div 
                            x-data="{ width: '{{ $progressPercent }}%' }"
                            x-bind:style="'width: ' + width"
                            class="bg-gradient-to-r from-green-400 via-green-500 to-green-600 h-8 text-white flex items-center justify-center font-semibold text-lg shadow-lg transition-all duration-700 ease-in-out"
                            style="min-width: 40px;"
                        >
                            {{ $progressPercent }}%
                        </div>
                    </div>


                    <p class="text-gray-700 text-sm">
                        {{ $doneLogs }} dari {{ $totalLogs }} hari ibadah selesai
                    </p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('ibadah.index') }}" class="inline-block px-6 py-3 bg-gray-700 text-white rounded-md hover:bg-gray-800 transition">
            Kembali ke Rencana Ibadah
        </a>
    </div>
</div>
@endsection
