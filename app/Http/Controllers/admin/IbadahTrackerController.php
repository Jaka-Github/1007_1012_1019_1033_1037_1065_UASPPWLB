<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IbadahPlan;
use App\Models\IbadahLog;
use Illuminate\Support\Facades\Auth;

class IbadahTrackerController extends Controller
{
    public function index()
    {
        $plans = IbadahPlan::where('user_id', Auth::id())->with('logs')->get();
        return view('users.ibadah.index', compact('plans'));
    }

    public function createPlan()
    {
        return view('users.ibadah.create-plan');
    }

    public function storePlan(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'target' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        IbadahPlan::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'target' => $request->target,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('users.ibadah.index')->with('success', 'Rencana ibadah berhasil ditambahkan!');
    }

    public function logForm($planId)
    {
        $plan = IbadahPlan::findOrFail($planId);
        return view('users.ibadah.log', compact('plan'));
    }

    public function storeLog(Request $request, $planId)
    {
        $request->validate([
            'date' => 'required|date',
            'is_done' => 'required|boolean',
            'note' => 'nullable|string',
        ]);

        IbadahLog::create([
            'user_id' => Auth::id(),
            'ibadah_plan_id' => $planId,
            'date' => $request->date,
            'is_done' => $request->is_done,
            'note' => $request->note,
        ]);

        return redirect()->route('users.ibadah.index')->with('success', 'Catatan ibadah berhasil ditambahkan.');
    }
}
