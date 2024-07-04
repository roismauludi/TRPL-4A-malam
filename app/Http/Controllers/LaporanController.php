<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; // Pastikan model Laporan diimport
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index($gedung)
    {
        // Ambil data dari tabel laporan berdasarkan gedung yang dipilih
        $data = Laporan::where('gedung', $gedung)->orderBy('tanggal')->get();

        // Ubah format data sesuai kebutuhan chart
        $lineChartData = $this->prepareLineChartData($data);
        $doughnutData = $this->prepareDoughnutData($data);

        // Tampilkan view sesuai dengan gedung yang dipilih
        return view('laporan.gedung', [
            'gedung' => $gedung,  // Kirimkan variabel gedung ke view
            'lineChartData' => $lineChartData,
            'doughnutData' => $doughnutData,
        ]);
    }


    /// Method untuk menyiapkan data untuk Line Chart
    private function prepareLineChartData($data)
    {
        $labels = $data->map(function ($item) {
            return date('d-m-Y', strtotime($item->tanggal)); // Ambil tanggal saja tanpa jam
        })->toArray();

        $values = $data->pluck('kwh')->toArray(); // Ambil kWh sebagai nilai

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }


    // Method untuk menyiapkan data untuk Doughnut Chart
    private function prepareDoughnutData($data)
    {
        $used = $data->sum('kwh'); // Total kWh yang digunakan
        $totalCapacity = $used; // Total kapasitas adalah total kWh yang digunakan

        return [
            'used' => $used,
            'totalCapacity' => $totalCapacity,
        ];
    }
}
