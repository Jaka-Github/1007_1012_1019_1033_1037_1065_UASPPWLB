<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IbadahPlan;
use App\Models\IbadahLog;

class IbadahController extends Controller
{
    // 🔍 Tampilkan semua rencana dan log ibadah milik user
    public function index()
    {
        $user = Auth::user();
        $plans = IbadahPlan::where('user_id', $user->id)->with('logs')->get();

        return view('users.ibadah.index', compact('plans'));
    }

    public function create()
    {
        return view('users.ibadah.create');
    }


    // ➕ Tambah rencana ibadah baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target' => 'nullable|string',
            'duration' => 'nullable|string',
             'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        IbadahPlan::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'target' => $request->target,
            'duration' => $request->duration,
            'start_date' => $request->start_date,  
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('ibadah.index')->with('success', 'Rencana ibadah berhasil ditambahkan.');

    }

        public function edit($id)
    {
        $plan = IbadahPlan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('users.ibadah.edit', compact('plan'));
    }


    // ✏️ Update rencana ibadah
    public function update(Request $request, $id)
    {
        $plan = IbadahPlan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target' => 'nullable|string',
            'duration' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $plan->update($request->only(['title', 'category', 'target', 'duration']));

        return redirect()->route('ibadah.index')->with('success', 'Rencana ibadah berhasil diperbarui.');
    }


    // ❌ Hapus rencana ibadah
    public function destroy($id)
    {
        $plan = IbadahPlan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $plan->delete();

        return redirect()->back()->with('success', 'Rencana ibadah berhasil dihapus.');
    }

        public function progress()
    {
        $user = Auth::user();
        // Contoh: ambil data progress ibadah user
        $plans = IbadahPlan::where('user_id', $user->id)->with('logs')->get();

        // Logika perhitungan progress bisa kamu tambahkan di sini

        return view('users.ibadah.progress', compact('plans'));
    }

    // ✅ Tambah log ibadah
    public function logIbadah(Request $request, $planId)
    {
        $request->validate([
            'status' => 'required|in:done,missed',
            'notes' => 'nullable|string',
        ]);

        $plan = IbadahPlan::where('id', $planId)->where('user_id', Auth::id())->firstOrFail();

        IbadahLog::create([
            'user_id' => Auth::id(),
            'ibadah_plan_id' => $plan->id,
            'date' => now()->toDateString(),
            'status' => $request->status === 'done' ? 1 : 0, // simpan ke kolom 'status'
            'notes' => $request->notes,
        ]);

        return redirect()->route('ibadah.index')->with('success', 'Log ibadah berhasil ditambahkan.');
    }

    public function updateLog(Request $request, $id)
    {
        $log = IbadahLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:done,missed',
            'notes' => 'nullable|string',
        ]);

        $log->update([
            'date' => $request->date,
            'is_done' => $request->status === 'done' ? true : false,
            'note' => $request->notes,
        ]);

        return redirect()->route('ibadah.index')->with('success', 'Log ibadah berhasil diperbarui.');
    }


    // ❌ Hapus log ibadah
    public function deleteLog($id)
    {
        $log = IbadahLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->delete();

        return redirect()->route('ibadah.index')->with('success', 'Log ibadah berhasil dihapus.');
    }
}
