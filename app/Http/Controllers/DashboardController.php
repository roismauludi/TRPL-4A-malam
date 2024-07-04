<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $gedung = [1, 2, 3];
        $lineChartDataHour = [];
        $lineChartDataDay = [];
        $doughnutData = [];

        foreach ($gedung as $gedung) {
            $data = Laporan::where('gedung', $gedung)->orderBy('tanggal')->get();

            $lineChartDataHour["Building {$gedung}"] = $this->prepareLineChartDataByHour($data);
            $lineChartDataDay["Building {$gedung}"] = $this->prepareLineChartDataByDay($data);
            $doughnutData["Building {$gedung}"] = $this->prepareDoughnutData($data);
        }

        return view('dashboard', [
            'lineChartDataHour' => $lineChartDataHour,
            'lineChartDataDay' => $lineChartDataDay,
            'doughnutData' => $doughnutData,
        ]);
    }

    private function prepareLineChartDataByHour($data)
    {
        $formattedData = [];
        $groupedData = $data->groupBy(function ($item) {
            return $item->tanggal->format('Y-m-d H:00:00');
        })->take(15);

        foreach ($groupedData as $tanggal => $items) {
            $averageKwh = $items->avg('kwh');
            $formattedTanggal = date('H:i', strtotime($tanggal));

            $formattedData['labels'][] = $formattedTanggal;
            $formattedData['values'][] = round($averageKwh, 2);
        }

        return $formattedData;
    }

    private function prepareLineChartDataByDay($data)
    {
        $formattedData = [];
        $groupedData = $data->groupBy('tanggal')->take(15);

        foreach ($groupedData as $tanggal => $items) {
            $averageKwh = $items->avg('kwh');
            $formattedTanggal = date('d-m-Y', strtotime($tanggal));

            $formattedData['labels'][] = $formattedTanggal;
            $formattedData['values'][] = round($averageKwh, 2);
        }

        return $formattedData;
    }

    private function prepareDoughnutData($data)
    {
        $used = $data->sum('kwh');
        $totalCapacity = $used;

        return [
            'used' => $used,
            'totalCapacity' => $totalCapacity,
        ];
    }
}
