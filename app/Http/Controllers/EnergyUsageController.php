<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Laporan;

class EnergyUsageController extends Controller
{
    public function downloadEnergyUsagePDF($gedung)
    {
        // Fetch data from 'laporan' table based on gedung
        $laporan = Laporan::where('gedung', $gedung)->orderBy('tanggal')->get();

        // Load view and convert to PDF
        $pdf = PDF::loadView('energy-usage-pdf', [
            'gedung' => $gedung,
            'laporan' => $laporan,
        ]);

        // Download the PDF file
        return $pdf->download("energy_usage_gedung{$gedung}.pdf");
    }
}
