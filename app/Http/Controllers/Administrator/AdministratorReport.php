<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporttodo;
use App\Models\User;
use Illuminate\Support\Str;

class AdministratorReport extends Controller
{
    public function index()
    {
        $reports = Reporttodo::orderBy('created_at', 'desc')
            ->paginate(10);

        $reports->getCollection()->transform(function ($report) {
            $user = User::where('uuid', $report->uuid)->first();
            $report->nama = $user ? $user->nama : 'Unknown';
            return $report;
        });

        return view('administrator.reporttodo.list', compact('reports'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $reports = Reporttodo::where(function ($query) use ($search) {
            $query->where('reporttodo_title', 'LIKE', "%{$search}%")
                ->orWhere('reporttodo_description', 'LIKE', "%{$search}%")
                ->orWhere('reporttodo_status', 'LIKE', "%{$search}%");
        })->paginate(10);

        $reports->getCollection()->transform(function ($report) {
            $user = User::where('uuid', $report->uuid)->first();
            $report->nama = $user ? $user->nama : 'Unknown';
            return $report;
        });

        return view('administrator.reporttodo.search', compact('reports', 'search'));
    }

    public function create()
    {
        return view('administrator.reporttodo.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        $userUuid = $request->input('uuid');  // Administrator bisa memilih pengguna

        Reporttodo::create([
            'reporttodo_uuid' => (string) Str::uuid(),
            'uuid' => $userUuid,
            'reporttodo_title' => $request->input('title'),
            'reporttodo_description' => $request->input('description'),
            'reporttodo_status' => $request->input('status'),
        ]);

        return redirect()->route('administrator.reporttodo.list')->with('success', 'Report To Do berhasil ditambahkan!');
    }

    public function edit($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)->firstOrFail();

        return view('administrator.reporttodo.edit', compact('report'));
    }

    public function update(Request $request, $reporttodo_uuid)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)->firstOrFail();

        $report->update([
            'reporttodo_title' => $request->input('title'),
            'reporttodo_description' => $request->input('description'),
            'reporttodo_status' => $request->input('status'),
        ]);

        return redirect()->route('administrator.reporttodo.list')->with('success', 'Report To Do berhasil diperbarui!');
    }

    public function konfirmasi($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)->firstOrFail();

        $user = User::where('uuid', $report->uuid)->first();
        $report->nama = $user ? $user->nama : 'Unknown';

        return view('administrator.reporttodo.konfirmasi', compact('report'));
    }

    public function destroy($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)->firstOrFail();

        $report->delete();

        return redirect()->route('administrator.reporttodo.list')->with('success', 'Report To Do berhasil dihapus!');
    }
}
