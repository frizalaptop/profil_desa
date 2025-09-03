<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = now()->toDateString();
        $activities = Activity::orderByRaw("
            CASE 
                WHEN event_date >= ? THEN 0 
                ELSE 1 
            END, event_date ASC
        ", [$today])
        ->paginate(5);
        return view('pages.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeAdmin();

        return view('pages.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'participant' => 'nullable|string',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'event_date'  => 'required|date',
            'thumbnail'   => 'nullable|image|max:2048',
            'status'      => 'in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('activities', 'public');
        }

        Activity::create($validated);

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('pages.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $this->authorizeAdmin();

        return view('pages.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'participant' => 'nullable|string',
            'description' => 'required|string',
            'location'    => 'nullable|string|max:255',
            'event_date'  => 'required|date',
            'thumbnail'   => 'nullable|image|max:2048',
            'status'      => 'in:draft,published',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail)) {
                Storage::disk('public')->delete($activity->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('activities', 'public');
        }

        $activity->update($validated);

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $this->authorizeAdmin();

        if ($activity->thumbnail && Storage::disk('public')->exists($activity->thumbnail)) {
            Storage::disk('public')->delete($activity->thumbnail);
        }

        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    /**
     * Helper untuk cek apakah user adalah admin
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melakukan aksi ini.');
        }
    }
}
