<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'kost_id' => 'required|exists:kosts,id',
            'report_text' => 'required|string',
        ]);

        $report = Report::create([
            ...$request->only(['user_id', 'kost_id', 'report_text']),
            'status' => 'pending'
        ]);

        return response()->json($report, 201);
    }
}
