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

        return redirect()->back()->with('success', 'Rencana ibadah berhasil diperbarui.');
    }

    // ❌ Hapus rencana ibadah
    public function delete($id)
    {
        $plan = IbadahPlan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $plan->delete();

        return redirect()->back()->with('success', 'Rencana ibadah berhasil dihapus.');
    }

    // ✅ Tambah log ibadah
    public function storeLog(Request $request)
    {
        $request->validate([
            'ibadah_plan_id' => 'required|exists:ibadah_plans,id',
            'date' => 'required|date',
            'status' => 'required|in:done,missed',
            'notes' => 'nullable|string',
        ]);

        $plan = IbadahPlan::where('id', $request->ibadah_plan_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

        IbadahLog::create([
            'user_id' => Auth::id(),
            'ibadah_plan_id' => $request->ibadah_plan_id,
            'date' => $request->date,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Log ibadah berhasil ditambahkan.');
    }

    public function progress()
    {
        $user = Auth::user();
        // Contoh: ambil data progress ibadah user
        $plans = IbadahPlan::where('user_id', $user->id)->with('logs')->get();

        // Logika perhitungan progress bisa kamu tambahkan di sini

        return view('users.ibadah.progress', compact('plans'));
    }


    // ✏️ Update log ibadah
    public function updateLog(Request $request, $id)
    {
        $log = IbadahLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:done,missed',
            'notes' => 'nullable|string',
        ]);

        $log->update($request->only(['date', 'status', 'notes']));

        return redirect()->back()->with('success', 'Log ibadah berhasil diperbarui.');
    }

    // ❌ Hapus log ibadah
    public function deleteLog($id)
    {
        $log = IbadahLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->delete();

        return redirect()->back()->with('success', 'Log ibadah berhasil dihapus.');
    }
}
