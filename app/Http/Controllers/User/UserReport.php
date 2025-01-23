<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporttodo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserReport extends Controller
{
    public function index()
    {
        $userUuid = Auth::user()->uuid;
        $reports = Reporttodo::where('uuid', $userUuid)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $reports->getCollection()->transform(function ($report) {
            $user = User::where('uuid', $report->uuid)->first();
            $report->nama = $user ? $user->nama : 'Unknown';
            return $report;
        });

        return view('user.reporttodo.list', compact('reports'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $reports = Reporttodo::where('uuid', Auth::user()->uuid)
            ->where(function ($query) use ($search) {
                $query->where('reporttodo_title', 'LIKE', "%{$search}%")
                    ->orWhere('reporttodo_description', 'LIKE', "%{$search}%")
                    ->orWhere('reporttodo_status', 'LIKE', "%{$search}%");
            })->paginate(10);

        $reports->getCollection()->transform(function ($report) {
            $user = User::where('uuid', $report->uuid)->first();
            $report->nama = $user ? $user->nama : 'Unknown';
            return $report;
        });

        return view('user.reporttodo.search', compact('reports', 'search'));
    }



    public function create()
    {
        return view('user.reporttodo.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string'
        ]);

        $userUuid = Auth::user()->uuid;

        Reporttodo::create([
            'reporttodo_uuid' => (string) Str::uuid(),
            'uuid' => $userUuid,
            'reporttodo_title' => $request->input('title'),
            'reporttodo_description' => $request->input('description'),
            'reporttodo_status' => $request->input('status'),
        ]);

        return redirect()->route('user.reporttodo.list')->with('success', 'Report To Do berhasil ditambahkan!');
    }

    public function edit($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)->firstOrFail();

        return view('user.reporttodo.edit', compact('report'));
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

        if ($report->uuid !== Auth::user()->uuid) {
            return redirect()->route('user.reporttodo.list')->with('error', 'Anda tidak memiliki izin untuk mengedit laporan ini.');
        }

        $report->update([
            'reporttodo_title' => $request->input('title'),
            'reporttodo_description' => $request->input('description'),
            'reporttodo_status' => $request->input('status'),
        ]);

        return redirect()->route('user.reporttodo.list')->with('success', 'Report To Do berhasil diperbarui!');
    }

    public function konfirmasi($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)
            ->where('uuid', Auth::user()->uuid)
            ->firstOrFail();

        $user = User::where('uuid', $report->uuid)->first();
        $report->nama = $user ? $user->nama : 'Unknown';

        return view('user.reporttodo.konfirmasi', compact('report'));
    }


    public function destroy($reporttodo_uuid)
    {
        $report = Reporttodo::where('reporttodo_uuid', $reporttodo_uuid)
            ->where('uuid', Auth::user()->uuid)
            ->firstOrFail();

        $report->delete();

        return redirect()->route('user.reporttodo.list')->with('success', 'Report To Do berhasil dihapus!');
    }
}
